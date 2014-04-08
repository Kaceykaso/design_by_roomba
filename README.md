#<a href="http://kaceykaso.github.io/design_by_roomba/index.html">Design by Roomba</a>

A crowdsourced picture drawn over a period of time by a Roomba Create; based on a series of commands submitted through a website, and received by a Raspberry Pi attached to the Roomba.


##Table of Contents

 - [Concept](#concept)
 - [Research](#research)
 - [Authors](#authors)
 - [License](#license)



## Concept

Design by Committee by Design

Roomba draws crowdsourced picture over a period of time; based on a series of commands submitted through a web app, and received by a Raspberry Pi ~~(or Arduino)~~ attached to the Roomba. Picture will eventually be created during a gallery exhibition.<br>
Commands are simplistic: right turn, left turn, forward, backward.

Expected outcome: Since user cannot see the Roomba, the picture will be rather chaotic.<br>
Ideal outcome: There are at least some recognizable patterns in the picture.

Objective: Prove design by committee, or large group collaboration, does or does not work. Prove “too many masters (or managers)” does or does deter progress.

### Phases

Optional Phase 2: Set up dropcam overlooking Roomba, with feed displayed on web app side-by-side with command submission form, so users get real time feedback.

Optional Phase 3: Add color; have multiple arms with different color sharpies attached, that lift and set down by servos. User can choose color in addition to directional command on website.

Optional Phase ??: Through Google Analytics on web app, find possible patterns in commands coming from certain countries, devices, OS’s, etc.


### Observations

 - Does lag, if any, create a significant problem in the design?
 - Does the Roomba get overloaded if too many commands are sent simultaneously?
 - How do you reset the Roomba when it hits a wall, so that it doesn’t interrupt the design?
 - Does the Raspberry Pi being on and constantly checking the web significantly affect the Roomba’s battery life?


### Equipment

 - <a href="http://store.irobot.com/product/index.jsp?productId=2586252">Roomba Create</a>
 - <a href="http://kaceykaso.github.io/design_by_roomba/index.html">Website with basic form</a>
 - <a href="http://www.raspberrypi.org/">Raspberry Pi</a> ~~or Arduino Yun~~
 - Gallery (Undergrad show or Best of ICAM?)
 - Large construction paper
 - Sharpie attached by a clamp or arm on the Roomba



## Research

Previous or related works:
 - <a href="http://www.instructables.com/id/Web-controlled-Twittering-Roomba/?ALLSTEPS">Web-controlled Twittering Roomba</a>
 - <a href="http://www.roborealm.com/tutorial/Fun_with_Roomba/slide090.php">Roomba Internet Control (outdated?)</a>
 - <a href="http://cfpm.org/~peter/connectingItUp.html">Roo Pi - controling a Roomba with a Raspberry Pi</a>



## Authors

**Kacey Coughlin**
 - <http://www.kaceycoughlin.com>
 - <http://github.com/Kaceykaso>


## License

[MIT License](LICENSE)
