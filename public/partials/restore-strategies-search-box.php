<section class="restore-strategies-search-box">
    <form method="get" action="<?php $_SERVER['REQUEST_URI'] ?>">
        <input
            type="text"
            name="q"
            placeholder="&nbsp;&nbsp;search opportunities"
            value="<?php echo (!empty($_GET['q']) ? $_GET['q'] : '') ?>"
        />
        <button type="submit">Search</button>
    </form>
</section>
<?php echo self::search_results_html($prefix); ?>
