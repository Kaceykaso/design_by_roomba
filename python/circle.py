#! /usr/bin/env python
# Circle script
# Executed when asked to draw a circle by the user
# Draws a 12 inch circle

import serial
import create
from time import strftime

# Create robot
robot = create.Create("/dev/ttyUSB0")
robot.toFullMode()

# Record current position, at start of drawing
pose = robot.getPose()
now = strftime("%H:%M:%S %m-%d-%Y")
line = "On %s I started drawing a TRIANGLE at:\n" % now
line += "X: %s\n" % pose[0]
line += "Y: %s\n" % pose[1]
line += "Theta: %s\n" % pose[2]
with open('positions.txt','a') as f:
  f.write(line)
f.closed

# Draw circle
# Circumference of circle with diameter of 12" = 37.5" (95.25cm)
# Degrees clockwise to move: 6.283 (radians) x r = 37.698 degrees
robot.go(95.25,-37.7)

# Record position now, at end of drawing
new_pose = robot.getPose()
new_now = strftime("%H:%M:%S %m-%d-%Y")
line = "On %s I started drawing a TRIANGLE at:\n" % new_now
line += "X: %s\n" % new_pose[0]
line += "Y: %s\n" % new_pose[1]
line += "Theta: %s\n" % new_pose[2]
with open('positions.txt','a') as f:
  f.write(line)
f.closed
