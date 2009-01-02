#!/usr/bin/env ruby -wKU
# Optimize screenshots for CWF-ng use
# Ruby version because Apple decided not ship GD with bundled PHP.

require "rubygems"
require "RMagick"


def wm_annotate(img)
  # Annotate image with a text
  watermark = Magick::Draw.new
  watermark.annotate(img,0,0,2,2,"CWF") {
    self.font_family = "helvetica"
    self.pointsize = 32
    self.stroke = "white"
    self.gravity = Magick::SouthEastGravity
    self.fill = "darkblue"
  }
  return img
end

tb_size = 150
path = "./originals/"
wm = Magick::Image.read("./cwf_watermark.png").first
for o_file in Dir.entries(path).grep(/.+\..{3}/) #.first(10)
  # o_file = "originals/scummvm1.png"
  basename,ext = o_file.split(/\./)
  img = Magick::Image.read(path+o_file).first
  puts "Original: #{img.base_filename}, size #{img.filesize/1024} kb (#{img.columns}x#{img.rows})"
# Watermark with text
# wm_annotate(img)
# Watermark in HSL-space
# wm_img = img.watermark(wm,1,0.5,Magick::SouthEastGravity,2,2)
# Add with CompositeOp
# wm_img = img.composite(wm,Magick::SouthEastGravity,2,2,Magick::OverCompositeOp)
# Dissolve with opacity
  unless File.exist?("./cache/#{basename}.#{ext.downcase}")
    wm_img = img.dissolve(wm,0.75,1,Magick::SouthEastGravity,2,2)
    puts "Writing full-size watermarked..."
    wm_img.write("./cache/#{basename}.#{ext.downcase}")
  end
  unless File.exist?("./cache/#{basename}-#{tb_size}w.#{ext.downcase}")
    thumb = img.resize_to_fit(tb_size,tb_size)
    puts "Writing thumbnail (width = #{tb_size}px)"
    thumb.write("./cache/#{basename}-#{tb_size}w.#{ext.downcase}") 
  end
end