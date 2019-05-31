@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="box">
        <div class="content">
            <h2>About the Barnes Three Dance Database</h2>
            <p><a href="https://www.cdss.org/vm-store/store-home/books/barnes-book-of-english-country-dance-tunes,-vol-3-detail">
                    <i>The Barnes Book of English Country Dance Tunes, volume three</i></a>,
                adds over 400 tunes to the collections in volumes one and two.
                The goal of this website is to provide information and instructions for all
                the dances in the third volume.
                Reaching this goal with a traditional publication would be an endless task.
                So I am instead taking an incremental approach and
                posting instructions for dances as they become available.
                The possibility to correct, amend, and expand is a welcome advantage of on-line publication.

            <p>The material in this project is available for personal use under the
                Creative Commons license <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/">
                    Attribution-NonCommercial-ShareAlike (CC BY-NC-SA)</a>.
                The dance instructions appear on this website with the permission
                of the choreographers and reconstructors or persons responsible for their estates.
                Other dances are listed with references to published sources for the instructions.
                The individual dances and tunes remain under the copyright of their
                choreographers and composers and may not be reprinted without their written permission.

            <p>This is a volunteer project with no source of income.
                So the only compensation offered to choreographers and reconstructors is
                references and links to the published source of the dance.
                You are encouraged to track down these publications for the full information and background on
                these
                dances.

            <h3>Conventions</h3>
            <p>Unless modified in the instructions, these conventions are to be followed.
            <ul>
                <li>An instruction for dancers to pass, gypsy, side, or orbit <b>right</b> or <b>left</b> means
                    that side of their bodies will be adjacent to the other dancers involved in the figure
                    even though the figure may start with the dancer shifting in the opposite direction.
                <li>An instruction for dancers to cast, loop, or turn <b>right</b> or <b>left</b> means
                    they will pull back that side of their bodies and turn in that direction.
                <li><b>Side by the right/left</b> means shoulder siding
                <li><b>Side over by the left and back by the right</b> means
                    swirly siding as attributed to Cecil Sharp.
                <li><b>Set</b> means step right (with a weight change left and right)
                    and step left (with a weight change right and left).
                <li><b>Turn single</b> is a clockwise turn (to the right)
                    in a circle behind your original position.
                <li>A <b>two-hand turn</b> is clockwise (to the left).
                <li>In a <b>back-to-back</b>, dancers pass by the right,
                    shift slightly to the right, and back up passing by the left.
                <li><b>Rights-and-lefts</b> involves taking hands as you pass the other dancers.
                <li>A <b>circular hey</b> involves passing the other dancers without taking hands.
            </ul>

            <h3>Notes</h3>
            <ul>
                <li>Instructions are given as imperatives rather than as description.
                <li>Instructions have been formatted in an attempt to follow the structure of
                    <ul>
                        <li>who (which dancers are involved in the figure),
                        <li>what (which figure is to be executed), and
                        <li>how (modification to the figure).
                    </ul>
                <li>Instructions in bold face are suggestions as to the essential figures
                    to include in the prompts for the dance.
                    The assumption is that the dancers will remember some of the details
                    mentioned during the teaching and walkthrough of the dance.
                    Of course, the calls will need to be adjusted to accommodate
                    the experience level of the dancers and their familiarity with the dance.
                    As the dancers learn the sequence of figures, these calls can be abbreviated or omitted.
            </ul>

            <h3>Dance Formations</h3>
            Below are the codes for the dance formations.
            <br>
{{--            <table style='table-layout:fixed; border-collapse:collapse; margin-left:40pt; margin-top:4pt'>--}}
                <table >
                    <tr>
                    <td >DML
                    <td >duple-minor longways
                    <td >2cL
                    <td >two-couple longways
                <tr>
                    <td>TML
                    <td>triple-minor longways
                    <td>3cL
                    <td>three-couple longways
                <tr>
                    <td>SC
                    <td>Sicilian circle
                    <td>4cL
                    <td>four-couple longways
                <tr>
                    <td>Cc
                    <td>circle of couples
                    <td>5cL
                    <td>five-couple longways
                <tr>
                    <td>
                    <td>
                    <td>6cL
                    <td>six-couple longways
                <tr>
                    <td>
                    <td>
                    <td>3cC
                    <td>three-couple circle
                <tr>
                    <td>
                    <td>
                    <td>4cS
                    <td>four-couple square
            </table>
            These can be modified by
            <table>
                <tr>
                    <td>i
                    <td>top couple improper in each minor set
                <tr>
                    <td>2i, 3i, 4i, etc.
                    <td>indicated couple or couples improper
                <tr>
                    <td>B
                    <td>Becket formation (couples proper facing across the set)
                <tr>
                    <td>m
                    <td>mixer
            </table>

            <h3>Difficulty and Energy Level</h3>
            Here are the guidelines I use in my subjective assignment of
            numerical values to the difficulty and energy level of these dances.
            <br>
            <table>
                <thead>
                <tr>
                    <th colspan=2>Difficulty</th>
                    <th colspan=2>Energy Level</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>5
                    <td>workshop dance
                    <td>5
                    <td>frantic
                <tr>
                    <td>4
                    <td>challenging for advanced dancers
                    <td>4
                    <td>vigorous
                <tr>
                    <td>3
                    <td>challenging for experienced dancers
                    <td>3
                    <td>moderate
                <tr>
                    <td>2
                    <td>a few points require care
                    <td>2
                    <td>calm
                <tr>
                    <td>1
                    <td>beginners will require help
                    <td>1
                    <td>deliberate
                <tr>
                    <td>0
                    <td>straightforward dance
                </tbody>
            </table>

            <h3>Acknowledgments</h3>
            <ul>
                <li><b>Kate Barnes</b> provided me with a list of the tunes to appear in volume three and
                    has encouraged me to undertake this project.
                <li><b>Allison Thompson</b> provided helpful advice in the early stages of this project.
                    Her <i>Dances from Barnes Two</i> was the underlying inspiration for this project.
                    She graciously shared her franchise on <i>Dances from Barnes N</i>
                    for small positive integer values of <i>N</i>
                <li><b>Will Jaynes</b> provided the database capabilities of this website and
                    generous amounts of time in working on the layout and content.
                <li><b>Marge Cramton</b> developed the design for the website and advised about font selection.
                <li>The many <b>choreographers and reconstructors</b> offered permission
                    for the use of their material.
                    Their artistic efforts in advancing English country dancing are the core of this project.
                <li>The <a href="https://www.cdss.org"><b>Country Dance and Song Society</b></a> (CDSS) provided support and guidance for this
                    project and sponsors this project with a link on their website.
                <li><a href="https://aactmad.org"><b>AACTMAD</b></a> (the Ann Arbor Community for Traditional Music and Dance)
                    provides computer resources to host this website.
                    Individual AACTMAD members and many of the programs offered by this organization
                    supported me in collecting and assembling this material.
            </ul>

            <h3>Comments and feedback</h3>
            <p>Comments and suggestions are welcome and encouraged.
                Let me know if you spot an error (from typographical to an incorrect or ambiguous instruction).
                I also appreciate receiving your ideas about improving these instructions
                in clarity, completeness, conciseness, or other ways.
                Contact me, <a href="http://mathcs.albion.edu/~ram">Robert Messer</a>, at ram@albion.edu.
        </div>
        </div>
    </div>
@endsection
