<section class="restore-strategies-confirmation">
    <div class="confirmation-message">
        <?php echo $this::confirmation_message(); ?>
    </div>
    <?php if (!$this::hide_message()): ?>
        <div class="opportunity-instructions">
            <?php echo $opp->instructions; ?>
        </div>
    <?php endif; ?>
</section>
