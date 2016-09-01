<article class="restore-strategies-opp <?php echo $class ?>">
    <div class="restore-strategies-opp-content">
        <b class="organization"><?php echo $opp->organization ?></b>
        <h3>
            <a href="/rs/show/?opportunity_id=<?php echo $opp->id; ?>">
                <?php echo $opp->name ?>
            </a>
        </h3>
        <div class="description"><?php echo $opp->description ?></div>
        
        <div class="details">
            <dl>
            <?php
                $html = '';
        
                if (!empty($opp->days)) {
                    $html .= '<div><dt>Days:</dt><dd>' . implode(', ', $opp->days) .
                            "</dd></div>\n";
                }
                if (!empty($opp->times)) {
                    $html .= '<div><dt>Times:</dt><dd>' . implode(', ', $opp->times) .
                            "</dd></div>\n";
                }
                if (!empty($opp->issues)) {
                    $html .= '<div><dt>Issues:</dt><dd>' . implode(', ', $opp->issues) .
                            "</dd></div>\n";
                }
                if (!empty($opp->regions)) {
                    $html .= '<div><dt>Regions:</dt><dd>' .
                            implode(', ', $opp->regions) . "</dd></div>\n";
                }
                if (!empty($opp->municipalities)) {
                    $html .= '<div><dt>Municipalities:</dt><dd>' . 
                            implode(', ', $opp->municipalities) . "</dd></div>\n";
                }
                if (!empty($opp->group_types)) {
                    $html .= '<div><dt>Group types:</dt><dd>' .
                            implode(', ', $opp->group_types) . "</dd></div>\n";
                }
        
                echo $html;
            ?>
            </dl>
        </div>
    </div>

    <div class="restore-strategies-opp-fader">&nbsp;</div>

    <div class="links">
        <a class="signup-link" href="/rs/form/?opportunity_id=<?php echo $opp->id; ?>">
            Signup
        </a>

        <a class="details-link" href="#">
            Details
        </a>
    </div>
</article>
