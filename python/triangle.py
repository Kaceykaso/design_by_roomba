# Triangle script
# Executed when asked to draw a triangle by the user
# Draws a 12 x 12 x 12 inch equilateral triangle

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

# Draw triangle
robot.move(305, 30) #12" equivilent in millimeters, rounded up
robot.turn(-120, 60)
robot.move(305, 30)
robot.turn(-120, 60)
robot.move(305, 30)

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