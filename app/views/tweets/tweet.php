<?php

/**
 * We don't have to use any templates, insert data via pure php
 * @var array $tweet array of tweet data
 */

?>
<div class="tweet-wrapper" data-href="<?= $tweet['entities']['urls']['url']?>">
    <div class="tweet-header">
        <img class="avatar" src="<?= $tweet['user']['profile_image_url']?>">
        <a class="author" href="<?= $tweet['user']['url']?>"><?= $tweet['user']['name']?></a>
    </div>
    <div class="tweet-body">
        <?= $tweet['text'] ?>
    </div>
</div>