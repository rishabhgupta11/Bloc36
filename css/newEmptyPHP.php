<?php
$offset = whatever();
$i = 0;
?>
<div class="container" style="display:flex;">
    <div class="noClass">
        <?php
        while($i <= $array[$offset])
        {
        ?>
            <p>Hello</p>
        <?php
        $i++;
        }
        ?>
    </div>
    <div class="theClassYouWant">
        <?php
        while($i <= $array[$offset+$length])
        {
        ?>
            <p>Your highlighted text</p>
        <?php
        $i++;
        }
        ?>
    </div>
    <div class="noClass">
        <?php
        while($i <= End of Array)
        {
        ?>
            <p>World</p>
        <?php
        $i++;
        }
        ?>
    </div>
</div>
