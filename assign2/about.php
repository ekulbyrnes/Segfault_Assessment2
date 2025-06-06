<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "include/header.inc";?>
    <title>About Us - SegFault Services</title>
</head>


<body>
    <!-- Header with aside logo and navbar -->
    <?php include "include/navbar.inc";?>
    <!-- end of header -->

    <section class="slideshow center-flex">
        <h1>About SegFault</h1><br>
        <div>
            <p class="newline-flex"><span class="terminalblink">_</span>From a 6th level floor in Swinburne, to here!<br>Learn all about us!</p>
        </div>
    </section>

    <section class="focus"> <!--Team Gallery-->
        <h1><span class="terminalblink">_</span>Our Team</h1>
        <div class="details-flex">
            <!-- Top Left Profile (lbyrnes)-->
            <aside class="left-item">
                <figure>
                    <img class="centerimage profile" src="images/lbyrnes.jpg" alt="Photo of Luke">
                    <figcaption><h3>Luke Byrnes</h3></figcaption>
                </figure>
                <h4>Solutions Architect</h4>
                <p>Luke enjoys digital empowerment, designing and maintaing systems that serve the needs of real people with genuine problems to solve.</p>
                <details>
                    <summary>More:</summary>
                        <p>Student ID: 7194587</p>
                        <p>Luke is an active polymath, an experienced Scout Leader, Amateur Radio Operator, and tech community member.</p>
                </details>
            </aside>
            <!-- Top Right Profile-->
            <aside class="right-item">
                <figure>
                        <img class="centerimage profile" src="images/vaum.jpg" alt="Photo of Vandy">
                        <figcaption><h3>Vandy Aum</h3></figcaption>
                </figure>
                        <h4>Artist</h4>
                        <p>I enjoy drawing a lot in my free time, but not just drawing that I like. I enjoy doing other things as well, as long as it is creative.</p>
                        <details>
                        <summary>More:</summary>
                        <p>Student ID: 105715697 </p>
                        <p>I am Vandy</p>
                        </details>

            </aside>
        </div>
    </section>
    <section class="focus"> <!--Team Gallery-->
        <div class="details-flex">
            <!-- Bottom Left Profile-->
            <aside class="left-item">
                <figure>
                        <img class="centerimage profile" src="images/marcus.jpg" alt="Photo of Marcus">
                        <figcaption><h3>Marcus Mifsud</h3></figcaption>
                </figure>
                        <h4>Music Producer</h4>
                        <p>Loves to spend time creating remixes and original music and is looking to start devloping his own audio plugins. He also enjoys spending his time rock climbing regularly.</p>
                        <details>
                        <summary>More:</summary>
                        <p>Student ID: 105875038</p>
                        <p>Marcus is currently looking for work.</p>
                        </details>

            </aside>
            <!-- Bottom Right Profile-->
            <aside class="right-item">
                <figure>
                        <img class="centerimage profile" src="images/nicole.png" alt="Photo of Nicole">
                        <figcaption><h3>Nicole Reichert</h3></figcaption>
                </figure>
                        <h4>Project Manager/Developer</h4>
                        <p>Loves to work in C and understand memory safety, Nicole also enjoys basketball and walking her dog in native bushland.</p>
                        <details>
                        <summary>More:</summary>
                        <p>Student ID: 100589839</p>
                        <p>I'm on the Kotlin team.</p>
                        </details>

            </aside>
        </div>
    </section>

    <section class="focus">
        <!-- Definition of the Group -->
        <h3>About this website:</h3>
        <dl class="groupdetails">
            <dt><strong>Our Name:</strong></dt>
            <dd>SegFault Services</dd>

            <dt><strong>Group ID:</strong></dt>
            <dd>2</dd>

            <dt><strong>Tutor Name:</strong></dt>
            <dd>Davi Mardamootoo</dd>

            <dt><strong>Course:</strong></dt>
            <dd>Computer Systems Project</dd>
        </dl>
    </section>
    <section class="focus center-text">
        <!-- timetable -->
        <h3>Our Timetable</h3>
        <table class="solidtable ">
            <thead>
                <tr>
                    <td>Monday</td>
                    <td>Tuesday</td>
                    <td>Wednesday</td>
                    <td>Thursday</td>
                    <td>Friday</td>
                </tr>
            </thead>
            <tbody>
                <tr> <!-- 0900 to 1100/morning value -->
                    <td>10:30-12:30</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr> <!-- 1100 to 1400/midday value -->
                    <td></td>
                    <td></td>
                    <td>10:30-12:30</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr> <!-- 1400 onwards/evening value -->
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>15:30-17:30</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </section>
    <!-- Footer -->
    <?php include "include/footer.inc";?>

</body>
</html>
