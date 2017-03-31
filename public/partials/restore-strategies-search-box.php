<section class="restore-strategies-search-box" id="restore-strategies-search-box">
    <form method="get" action="<?php $_SERVER['REQUEST_URI'] ?>#restore-strategies-search-box">
        <input
            type="search"
            name="q"
            placeholder="&nbsp;&nbsp;search opportunities"
            value="<?php echo (!empty($_GET['q']) ? $_GET['q'] : '') ?>"
        />

        <div class="restore-strategies-search-buttons">
            <button type="submit">Search</button>
            <?php if ($advanced): ?>
                <button id="advanced-search"type="button">Advanced</button>
            <?php endif; ?>
        </div>

        <?php if ($advanced): ?>

            <div class="restore-strategies-search-categories <?php if ($collapse) { echo 'restore-strategies-collapse'; } ?>">

                <?php if (!empty($category_title) || !empty($category)): ?>
                    <div class="restore-strategies-search-category">
                        <h6><?php echo $category_title; ?></h6>
                        <ul>
                            <?php foreach ($category as $item): ?>
                                <li>
                                    <input
                                        type="checkbox"
                                        name="custom_category[]"
                                        id="<?php echo $item; ?>"
                                        value="<?php echo $item ?>"
                                        <?php
                                            $bool = !is_null($_GET['custom_category']) &&
                                                    in_array($item, $_GET['custom_category']);

                                            if ($bool) {
                                                echo 'checked';
                                            }
                                        ?>
                                    />
                                    <?php echo $item; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!in_array('Issues', $exclude)): ?>
                    <div class="restore-strategies-search-category">
                        <h6>Issues</h6>
                        <ul>
                            <?php foreach (self::issues() as $issue): ?>
                                <li>
                                    <input
                                        type="checkbox"
                                        name="issues[]"
                                        id="<?php echo $issue ?>"
                                        value="<?php echo $issue ?>"
                                        <?php
                                            $bool = !is_null($_GET['issues']) &&
                                                    in_array($issue, $_GET['issues']);

                                            if ($bool) {
                                                echo 'checked';
                                            }
                                        ?>
                                    />
                                    <?php echo $issue ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!in_array('Regions', $exclude)): ?>
                    <div class="restore-strategies-search-category">
                        <h6>Regions</h6>
                        <ul>
                            <?php foreach (self::regions() as $region): ?>
                                <li>
                                    <input
                                        type="checkbox"
                                        name="regions[]"
                                        id="<?php echo $region ?>"
                                        value="<?php echo $region ?>"
                                        <?php
                                            $bool = !is_null($_GET['regions']) &&
                                                    in_array($region, $_GET['regions']);

                                            if ($bool) {
                                                echo 'checked';
                                            }
                                        ?>
                                    />
                                    <?php echo $region ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!in_array('Types', $exclude)): ?>               
                    <div class="restore-strategies-search-category">
                        <h6>Types</h6>
                        <ul>
                            <?php foreach (self::types() as $type): ?>
                                <li>
                                    <input
                                        type="checkbox"
                                        name="types[]"
                                        id="<?php echo $type ?>"
                                        value="<?php echo $type ?>"
                                        <?php
                                            $bool = !is_null($_GET['types']) &&
                                                    in_array($type, $_GET['types']);

                                            if ($bool) {
                                                echo 'checked';
                                            }
                                        ?>
                                    />
                                    <?php echo $type ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!in_array('Times', $exclude)): ?>
                    <div class="restore-strategies-search-category">
                        <h6>Times</h6>
                        <ul>
                            <?php foreach (self::times() as $time): ?>
                                <li>
                                    <input
                                        type="checkbox"
                                        name="times[]"
                                        id="<?php echo $time ?>"
                                        value="<?php echo $time ?>"
                                        <?php
                                            $bool = !is_null($_GET['times']) &&
                                                    in_array($time, $_GET['times']);

                                            if ($bool) {
                                                echo 'checked';
                                            }
                                        ?>
                                    />
                                    <?php echo $time ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!in_array('Groups', $exclude)): ?>
                    <div class="restore-strategies-search-category">
                        <h6>Groups</h6>
                        <ul>
                            <?php foreach (self::group_types() as $group_type): ?>
                                <li>
                                    <input
                                        type="checkbox"
                                        name="group_types[]"
                                        id="<?php echo $group_type ?>"
                                        value="<?php echo $group_type ?>"
                                        <?php
                                            $bool = !is_null($_GET['group_types']) &&
                                                    in_array($group_type, $_GET['group_types']);

                                            if ($bool) {
                                                echo 'checked';
                                            }
                                        ?>
                                    />
                                    <?php echo $group_type ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!in_array('Days', $exclude)): ?>
                    <div class="restore-strategies-search-category">
                        <h6>Days</h6>
                        <ul>
                            <?php foreach (self::days() as $day): ?>
                                <li>
                                    <input
                                        type="checkbox"
                                        name="days[]"
                                        id="<?php echo $day ?>"
                                        value="<?php echo $day ?>"
                                        <?php
                                            $bool = !is_null($_GET['days']) &&
                                                    in_array($day, $_GET['days']);

                                            if ($bool) {
                                                echo 'checked';
                                            }
                                        ?>
                                    />
                                    <?php echo $day ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

            </div>
        <?php endif; ?>
    </form>

    <div class="restore-strategies-search-results">
        <?php echo self::search_results_html($prefix); ?>
    </div>
</section>
