"""
Simple test script that runs through a few of the methods from the Create API
found at:
http://www.cs.gmu.edu/~zduric/cs101/pmwiki.php/Main/APITutorial
"""

import serial
import create

# Create the Create!
robot = create.Create("/dev/ttyUSB0")

"""
Safe Mode does not allow Create to move why plugged in, run off cliffs, and stops and adjusts when bumped.
Full Mode ignores all that
"""
#robot.toSafeMode()
robot.toFullMode()

# Move forward in millimeters; optional second parameters is speed (cm/s)
robot.move(6)
# Stop
robot.stop()

# Play a C chord
robot.playSong( [(60,8),(64,8),(67,8),(72.)] )

"""
Get current position of Create (x,y,theta),
where theta is the angle the Create is facing.
"""
pose = robot.getPose();
print "My X is %s" % pose[0]
print "My Y is %s" % pose[1]
print "My Theta is %s" % pose[2]
