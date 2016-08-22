<?php
    $opp = self::opportunity($id);
?>

<section class="restore-strategies-signup">
    <?php if(!empty($_POST)): ?>
        <?php
            $errorMsg = null;
            $valid = self::validate_signup($_POST);
        
            if ($valid) {
                $response = $this->client->submitSignup($opp->id, $_POST);
    
                if ($response->raw()->status == 202) {
                    include('restore-strategies-signup-confirm.php');
                }
                else {
                    // API rejects signup
                    $errorMsg = explode(',', $response->error()->message);
                    include('restore-strategies-signup-form.php');
                }
            }
            else {
                // client rejects
                include('restore-strategies-signup-form.php');
            }
        ?>
    <?php else: ?>
        <?php include('restore-strategies-signup-form.php'); ?>
    <?php endif; ?>
</section>
