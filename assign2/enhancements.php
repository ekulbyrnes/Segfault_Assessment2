<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "include/header.inc";?>
    <title>Enhancements - SegFault Services</title>
</head>


<body>
    <!-- Header with aside logo and navbar -->
    <?php include "include/navbar.inc";?>
    <!-- end of header -->

    <!-- Nicole HTML START -->
    <section class="slideshow center-flex">
        <h1>Enhancements</h1><br>
        <div>
            <p class="newline-flex"><span class="terminalblink" id="enhancement_1">_</span>Get to know how we made this site.<br>Flexbox, pseudoclasses and more!</p>
        </div>
    </section>


    <section class="focus center-text">
        <h3>Objective</h3>
        <p>On this page, our objective is to <em>list and describe</em> each enhancement
        created on the website so far.</p>
        <h5>We will aim to show:</h5>
        <ul class="no-list-decor">
            <li>How it goes beyond the basic requirements of this assignment,</li>
            <li>What code is needed to implement the feature,</li>
            <li>The references to any third-party sources for the technique,</li>
            <li>We will ensure all enhancements work on Firefox.</li>
        </ul>
        <p>Because of this, we may refer you to alternate sections of the site tree with id tags, allowing you
        to focus on the specific piece of content to be assesed.</p>

    </section>
    <section class="focus"> <!--Enhancements List-->
        <h3 class="center-text">Enhancements Section</h3>
        <div class="details-flex centertext" >
            <aside class="left-item">
                <h4>Terminal Cursor Animation</h4>
                <h6 class="pulse"><a href="#enhancement_1" class="no-link-decor">[Click to Enhancement (#enhancement_1)]</a></h6>
                <p>In our website, we have (attempted) to create tasteful use of the
                CSS animation definitions. An example of the terminalblink class,
                where we set a simple blinker animation with one keyframe.</p>
                <p class="code-block">
                    <br>
                    .<span>terminalblink</span> {animation: blinker 0.3s infinite;}<br>
                    @<span>keyframes</span> blinker {50% {opacity: 0;}<br>
                    <br>
                </p>
                <p>This isn't our only use of CSS animations - both the navigation links and
                the pulse class at the link above extend this using psuedoclass selectors to
                define behaviour based on what the user does on the browser.</p>
                <p class="code-block">
                    <br>
                    .<span>navpage</span> {display: block;color: white;text-align: center;padding: 14px 16px;text-decoration: none;transition: 0.5s;}<br>
                    .<span>navpage</span>:hover {padding-top: 15px;padding-bottom: 5px;transform: rotate(-5deg);}<br>
                    <br>
                </p>
                <p>Learning keyframes and the shorthand notation for animations within CSS was learnt via the MDN documentation<sup><a href="#ref1">[1]</a></sup>.</p>
                <span><strong>Citations (IEEE):</strong></span>
                <ul>
                    <li><a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_animations/Using_CSS_animations" class="no-link-decor" target="_blank" id="ref1">
                        <em>[1]Mozilla Foundation, “Using CSS animations - CSS: Cascading Style Sheets,” MDN Web Docs. Accessed: Mar. 03, 2025. [Online]. Available: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_animations/Using_CSS_animations</em></a>
                    </li>
                </ul>
            </aside>
            <aside class="right-item">
                <h4>Flex Display</h4>
                <h6 class="pulse"><a href="#enhancement_2" class="no-link-decor">[Click to Enhancement (#enhancement_2)]</a></h6>
                <p>Early into the development of the website, we tried to use float attributes to move
                entire sections of media either to the left or right, allowing us to organise content.<br><br>
                Although we aren't thinking about dynamic displays in this assignment, we moved most items in the website to
                use the flex-box display type within our sections to load content in the <em>display-flex, left-item, right-item and flex-shout</em> classes.</p>
                <p class="code-block">
                    <!-- I use a lot of span tags here to help style selectors here, sorry! -- Nicole -->
                    <br>
                    .<span>details-flex</span> {display: flex;justify-content: center;align-items: stretch;flex-wrap: wrap;align-content: stretch;height: 100%;gap: 5px;}<br>
                    .<span>details-flex > * > *</span> {text-align: center;list-style-type: none;}<br>
                    .<span>details-flex > * picture img</span> {border-radius: 1em;transform: translate(-20%);transition: 0.3s;}<br>
                    .<span>details-flex > * picture img</span>:hover {transform: translate(-2%);}<br>
                    .<span>left-item, .right-item</span> {flex:1 0 40%;}<br>
                    .<span>overflow-item</span> {/* flex:1 1 100%; */ order:3;flex-grow:1;flex-basis:100%;align-self:auto;}<br>
                    <br>
                </p>
                <p>To learn more about flexbox styling in CSS, I found a few interactive<sup><a href="#ref2">[2]</a></sup> websites that allow you to play with an understand flexbox
                as it works in both the grow/shrink attributes, and it's shorthand notation.</p>
                <p>Mozilla also provides great documentation<sup><a href="#ref3">[3]</a></sup> on flexbox, allowing me to understand further on how
                web developers properly 'line-break' their flexboxes by having a 1 flexbox long item that overflows.</p>
                <span><strong>Citations (IEEE):</strong></span>
                <ul>
                    <li><a href="https://www.joshwcomeau.com/css/interactive-guide-to-flexbox/" class="no-link-decor" target="_blank" id="ref2">
                        <em>[2] J. W. Comeau, “An Interactive Guide to Flexbox in CSS • Josh W. Comeau,” Interactive Guide to Flexbox, https://www.joshwcomeau.com/css/interactive-guide-to-flexbox/ (accessed Mar. 5, 2025).</em></a>
                    </li>
                    <li>
                        <a href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_animations/Using_CSS_animations" class="no-link-decor" target="_blank" id="ref3"><em>[3] MozDevNet, “Using CSS animations - CSS: Cascading style sheets: MDN,” MDN Web Docs, https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_animations/Using_CSS_animations (accessed Mar. 5, 2025).</em></a>
                    </li>
                </ul>
            </aside>
        </div>
    </section>
    <!-- Nicole HTML END -->
    <!-- Nicole Footer -->
    <?php include "include/footer.inc";?>
</body>
</html>
