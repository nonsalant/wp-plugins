<?php $singleItemTemplate = <<<HTML
    <article class="post type-post status-publish format-standard has-post-thumbnail hentry u-content-bottom-spacing">
        <div class="c-card">
            <div class="c-card__aside c-card__thumbnail-background">
                <div class="c-card__frame">
                    <img width="450" height="360" src="{$img}" class="attachment-pixelgrade_card_image size-pixelgrade_card_image wp-post-image is-loaded">
                    <!--<span class="c-card__letter" style="font-size: 90.6617px;">-->
                    <span class="c-card__letter" style="font-size: 126px;">{$title[0]}</span>
                </div>
            </div>
            <div class="c-card__content">
                <h2 class="c-card__title">
                    <span>{$title}</span>
                </h2>
                <div class="c-card__excerpt">
                    {$excerpt}
                </div>
                <div class="c-card__footer">
                <a href="{$uri}" class="c-card__action">READ MORE</a> </div>
            </div>
            <a class="c-card__link" href="{$uri}"></a>
            <div class="c-card__badge"></div>
        </div>
    </article>
HTML;