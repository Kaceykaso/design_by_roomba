#! /usr/bin/env python
# Square script
# Executed when asked to draw a square by the user
# Draws a 45cm square

import serial
import create
from time import strftime

# Create robot
robot = create.Create("/dev/ttyUSB0")
#robot.toFullMode()
robot.toSafeMode()

sensors = robot.sensors([create.LEFT_BUMP, create.RIGHT_BUMP]) #Front bumper sesnors

while not(sensors[create.LEFT_BUMP] == 1 or sensors[create.RIGHT_BUMP] == 1):
  # Draw square
  robot.move(45, 30) # ~12.5" equivilent in cm, rounded up; at 30cm/s
  robot.turn(-90, 60) # 90 degrees clockwise, 60 degrees/s
  robot.move(45, 30)
  robot.turn(-90, 60)
  robot.move(45, 30)
  robot.turn(-90, 60)
  robot.move(45, 30)
else:
  robot.move(-15,30)
  robot.turn(-90,60)
