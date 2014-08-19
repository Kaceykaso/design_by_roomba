#<a href="http://kaceykaso.github.io/design_by_roomba/index.html">Design by Roomba</a>

A web-controlled iRobot Create (Roomba), via a webserver hosted on a connected Raspberry Pi, that allows the user to command the robot to draw a series of shapes. Can be controlled by multiple users at a time.


##Table of Contents

 - [Concept](#concept)
  - [Blog](../../wiki)
  - [Videos](#videos)
 - [Research](#research)
 - [Author](#author)
 - [License](#license)



## Concept

Design by Committee by Design

The Create draws crowdsourced, or individual user's, picture over a period of time; based on a series of commands submitted through a web app, and received by a Raspberry Pi ~~(or Arduino)~~ attached to the Create. Picture will be created during a gallery exhibition over an hour or two, with users at laptop/tablet stations, sending commands via the website.

Commands are simplistic: right turn, left turn, forward, backward.

##### Edit:
Slight variation on the theme; above has been changed into "Command Mode", with the alternative "Bob Ross Mode". In Bob Ross Mode, the Create, or RossBot, communicates with the user through the website being hosted on the Raspberry Pi. The RossBot parses keywords from the conversation to learn what the user would like to draw, and after confirming with the user, executes a Python script to draw the requested element.

RossBot Commands, or keywords: circle, square, triangle, line, zigzag, tree, cloud, and test (for testing purposes).<br>
There also may or may not be some easter egg commands.

Read the [project's blog](../../wiki) for more details and documentation.

#### Videos
Watch the evolution of [RossBot on YouTube](https://www.youtube.com/playlist?list=PLWnhVchApyJveY8cioEd4EkjYBgywtLct).



## Research

Previous or related works:
 - [Harold Cohen's AARON](http://www.viewingspace.com/genetics_culture/pages_genetics_culture/gc_w05/cohen_h.htm)
 - <a href="http://www.instructables.com/id/Web-controlled-Twittering-Roomba/?ALLSTEPS">Web-controlled Twittering Roomba</a>
 - <https://www.youtube.com/watch?v=DzkG3q3HmtM>
 - [RoombaSpiro](http://books.google.com/books?id=cKawNJgYcj8C&pg=PA184&lpg=PA184&dq=roombaspiro&source=bl&ots=uN2p2KuQX7&sig=xoPOQ_cSYg7DlCiJ8H4xPvp0s8w&hl=en&sa=X&ei=HOxfU4uAOcKtyATF9oHgBA&ved=0CC4Q6AEwAA#v=onepage&q=roombaspiro&f=false)
 - ~~<a href="http://www.roborealm.com/tutorial/Fun_with_Roomba/slide090.php">Roomba Internet Control (outdated?)</a>~~
 - <a href="http://cfpm.org/~peter/connectingItUp.html">Roo Pi - controling a Roomba with a Raspberry Pi</a>
 - <http://www.instructables.com/id/OLPC-Telepresence/>
 - <https://code.google.com/p/pyrobot/>
 - <http://pi.gate.ac.uk/pages/piroomba.html>
 - [Yet another Roomba+RPi+Webcam project](https://github.com/mirobotclub/RoombaPi)

Tools, Libraries, Interesting things:
 - ~~<https://code.google.com/p/webiopi/>~~
 - <http://www.lighttpd.net/>
 - <https://projects.drogon.net/raspberry-pi/wiringpi/serial-library/>
 - <http://www.davidhunt.ie/add-a-9-pin-serial-port-to-your-raspberry-pi-in-10-minutes/>
 - [GMU course using Creates to teach Computer Science](http://www.cs.gmu.edu/~zduric/cs101/pmwiki.php/Main/Installation)
 - [Not terribly related, but cool anyways](http://sidigital.co/sid)
 
### Diagrams

 - [Create 25-pin Cargo Bay Connector](blog/2014/april/img/create_serial_pinout.png)
 - [Create 7-pin Serial](blog/2014/april/img/create_7-pin_pinout.png)
 - [RPi GPIO pinout](blog/2014/april/img/rpi_gpio_pin_out.png)
 - [5V Regulator](blog/2014/april/img/5v_regulator.jpg)



## Author

**Kacey Coughlin**
 - <http://www.kaceycoughlin.com>
 - <http://github.com/Kaceykaso>


## License

[MIT License](LICENSE)
