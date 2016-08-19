<?php
    $opp = self::opportunity($id);
?>

<?php if(!empty($_POST)): ?>
    <?php $valid = self::validate_signup($_POST); ?>
<?php else: ?>
    <section class="restore-strategies-signup">
        <h2>Connect to <?php echo $opp->name ?> - <?php echo $opp->organization ?></h2>
        
        <p><?php echo $opp->description ?></p>
        
        <form method="post" action="">
            <input type="text" placeholder="first name" name="givenName" />
            <input type="text" placeholder="last name" name="familyName" />
            <input type="text" placeholder="email" name="email" />
            <input type="text" placeholder="phone" name="telephone" />
            <?php if ($opp->max_items_needed > 0): ?>
                <span class="gift-question">
                    <?php echo $opp->gift_question ?>
                </span>
                <input type="text" placeholder="e.g. 3" name="numOfItemsCommitted"/>
            <?php endif; ?>
             
            <textarea placeholder="comments & questions" name="comment"></textarea>
    
            <button type="submit">Signup</button>
        </form>
    </section>
<?php endif; ?>
