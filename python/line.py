#! /usr/bin/env python
# Line script
# Executed when asked to draw a line by the user
# Draws a 12 inch line segment

import serial
import create
from time import strftime

# Create robot
robot = create.Create("/dev/ttyUSB0")
robot.toFullMode()

# Record current position, at start of drawing
pose = robot.getPose()
now = strftime("%H:%M:%S %m-%d-%Y")
line = "On %s I started drawing a LINE at:\n" % now
line += "X: %s\n" % pose[0]
line += "Y: %s\n" % pose[1]
line += "Theta: %s\n" % pose[2]
#with open('positions.txt','a') as f:
#  f.write(line)
#f.closed

# Draw line
robot.move(45, 30) # 12.5" equivilent in cm, rounded up, 30cm/s

# Record position now, at end of drawing
new_pose = robot.getPose()
new_now = strftime("%H:%M:%S %m-%d-%Y")
line = "On %s I finished drawing a LINE at:\n" % new_now
line += "X: %s\n" % new_pose[0]
line += "Y: %s\n" % new_pose[1]
line += "Theta: %s\n" % new_pose[2]
#with open('positions.txt','a') as f:
#  f.write(line)
#f.closed
