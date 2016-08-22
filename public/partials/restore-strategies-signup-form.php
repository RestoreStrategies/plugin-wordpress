<h2>Connect to <?php echo $opp->name ?> - <?php echo $opp->organization ?></h2>

<p><?php echo $opp->description ?></p>

<form method="post" action="">
    <?php
        if (!is_null($valid) && $valid == false) {
            echo '<p class="error">We\'re sorry, there seems to be a problem with the form you submitted</p>';
        }
        if (!is_null($errorMsg)) {
            echo '<p class="error">We\'re sorry, there seems to be a problem with the form you submitted</p>';

            echo '<ul class="error">';

            for ($i = 0; $i < count($errorMsg); $i++) {
                echo '<li>' . $errorMsg[$i] . '</li>';
            }

            echo '</ul>';
        }
    ?>

    <input
        title="(required) first name"
        placeholder="first name*"
        type="text"
        name="givenName"
        required
        value="<?php if(!empty($_POST['givenName'])) { echo $_POST['givenName']; } ?>"
    />

    <input 
        title="(required) last name"
        placeholder="last name*"
        type="text"
        name="familyName"
        required
        value="<?php if(!empty($_POST['familyName'])) { echo $_POST['familyName']; } ?>"
    />

    <input
        title="(required) email address"
        placeholder="email*"
        type="email"
        name="email"
        required
        value="<?php if(!empty($_POST['email'])) { echo $_POST['email']; } ?>"
    />

    <input
        title="(required) phone number"
        placeholder="phone*"
        type="tel"
        name="telephone"
        required
        value="<?php if(!empty($_POST['telephone'])) { echo $_POST['telephone']; } ?>"
    />

    <?php if ($this::include_church()): ?>
        <input
            title="what church are you a part of?"
            placeholder="your church"
            type="text"
            name="church"
            required
            value="<?php if(!empty($_POST['church'])) { echo $_POST['church']; } ?>"
        />
    <?php endif; ?>

    <?php if ($this::include_campus()): ?>
        <input
            title="what campus are you a part of?"
            placeholder="your church campus"
            type="text"
            name="campus"
            required
            value="<?php if(!empty($_POST['campus'])) { echo $_POST['campus']; } ?>"
        />
    <?php endif; ?>

    <?php if ($opp->max_items_needed > 0): ?>
        <span class="gift-question">
            <?php echo $opp->gift_question ?>
        </span>

        <input
            type="text"
            placeholder="e.g. 3"
            name="numOfItemsCommitted"
            required
            value="<?php if(!empty($_POST['numOfItemsCommitted'])) { echo $_POST['numOfItemsCommitted']; } ?>"
        />
    <?php endif; ?>

    <textarea placeholder="comments & questions" name="comment"><?php if(!empty($_POST['comment'])) { echo $_POST['comment']; } ?></textarea>

    <button type="submit">Signup</button>
</form>
