<style type="text/css">
    div h1{
        font-family:Arial, Helvetica, sans-serif;
        font-size:20px;
        color:#55917A;
    }
    div p{
        color: #333333;
        font-family: Verdana,Arial,Helvetica,sans-serif;
        font-size: 13px;
        font-weight: normal;
        padding: 5px;
    }
    /* -------------------------------------- */
    .gradientBoxesWithOuterShadows { 
        height: 100px;
        padding: 5px;
        background-color: white;

        /* rounded corners */
        -webkit-border-radius: 12px;
        -moz-border-radius: 7px; 
        border-radius: 7px;

        /* gradients */
        background-image: -webkit-linear-gradient(top, hsl(0, 80%, 70%), #bada55); /* For Chrome and Safari */
        background-image:    -moz-linear-gradient(top, hsl(0, 80%, 70%), #bada55); /* For old Fx (3.6 to 15) */
        background-image:     -ms-linear-gradient(top, hsl(0, 80%, 70%), #bada55); /* For pre-releases of IE 10*/
        background-image:      -o-linear-gradient(top, hsl(0, 80%, 70%), #bada55); /* For old Opera (11.1 to 12.0) */
        background-image:         linear-gradient(to bottom, hsl(0, 80%, 70%), #bada55); /* Standard syntax; must be last */
    }
    .gradientBoxesWithOuterShadows h2{
        font-family: Cambria, 'Times New Roman', tahoma; 
        font-weight: bold; 
        font-size: 1.2em;
        text-align: center;
        color: #ffffff;
    }
    .gradientBoxesWithOuterShadows div{
        font-family: 'Times New Roman', tahoma;
        font-size: 1.1em;
        text-align: center;
        padding-top: 2px
    }
    .gradientBoxesWithOuterShadows span{
        display: block;
        position: relative;
        left: 160px;
        top: 10px;
        text-decoration: none;
    }
</style>
<div class="clearfix" style="text-align:justify;border-bottom: 5px solid transparent">
    <h1 align="center">The Society</h1>
    <p>
        The Society originated in 2009. The purposes of the Society are to:Interact the students with the real professional world.
        At least arrange one seminar within a semister. Try to arrange some courses in there relevant department as much as possible.
        At least arrange one workshop within a semister. Try to share any knowledge among the students as related. Try to arrange at least one intra DUET programming contest(IDPC) within a semister.
        If possible then arrange a programming contest among the universities of bangladesh. Try to arrange a project fair.
    </p>
    <div class="grid_13" style="margin-top:10px">
    <div class="gradientBoxesWithOuterShadows grid_6">
        <h2>Algorithm Development &amp; Programming Group</h2>
        <div>[This club is working to improve the programming skills]</div>
        <span><?=anchor('groups/application_project', 'Details >>')?></span>
    </div>
    <div class="gradientBoxesWithOuterShadows grid_6">
        <h2>Application &amp; Project Development Group</h2>
        <div>[This club is working to develop real time project]</div>
        <span><?=anchor('groups/application_project', 'Details >>')?></span>
    </div>
    </div>
    <div class="grid_13" style="margin-top:10px">
    <div class="gradientBoxesWithOuterShadows grid_6">
        <h2>Network &amp; Communication Group</h2>
        <div>[This club is working to develop network related project]</div>
        <span><?=anchor('groups/application_project', 'Details >>')?></span>
    </div>
    <div class="gradientBoxesWithOuterShadows grid_6">
        <h2>Multimedia &amp; Gaming Group</h2>
        <br/>
        <div>[This club is working with graphics design and game]</div>
        <span><?=anchor('groups/application_project', 'Details >>')?></span>
    </div>
    </div>
    <div class="grid_13" style="margin-top:10px">
    <div class="gradientBoxesWithOuterShadows grid_6">
        <h2>Co-Curricular activities Group</h2>
        <br/>
        <div>[This club is responsible with setup different types of program]</div>
        <span><?=anchor('groups/application_project', 'Details >>')?></span>
    </div>
    <div class="gradientBoxesWithOuterShadows grid_6">
        <h2>Liaison &amp; Publications  Group</h2>
        <br/>
        <div>[This club is responsible with interpersonal communication]</div>
        <span><?=anchor('groups/application_project', 'Details >>')?></span>
    </div>
    </div>
</div>
