<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $tab string */
?>
<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item <?= $tab == 'dashboard' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= Url::to(['/site/dashboard']) ?>">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard" width="24"
                           height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                           stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <circle cx="12" cy="13" r="2"></circle>
   <line x1="13.45" y1="11.55" x2="15.5" y2="9.5"></line>
   <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
</svg>
                    </span>
                            <span class="nav-link-title"><?= Yii::t('codices', 'Dashboard') ?></span>
                        </a>
                    </li>

                    <li class="nav-item <?= $tab == 'books' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= Url::to(['/books/index']) ?>">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
   <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0"></path>
   <line x1="3" y1="6" x2="3" y2="19"></line>
   <line x1="12" y1="6" x2="12" y2="19"></line>
   <line x1="21" y1="6" x2="21" y2="19"></line>
</svg>
                    </span>
                            <span class="nav-link-title"><?= Yii::t('codices', 'Books') ?></span>
                        </a>
                    </li>
                    <li class="nav-item <?= $tab == 'collections' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= Url::to(['/collections/index']) ?>">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-books" width="24"
                             height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                             stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <rect x="5" y="4" width="4" height="16" rx="1"></rect>
   <rect x="9" y="4" width="4" height="16" rx="1"></rect>
   <path d="M5 8h4"></path>
   <path d="M9 16h4"></path>
   <path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z"></path>
   <path d="M14 9l4 -1"></path>
   <path d="M16 16l3.923 -.98"></path>
</svg>
                    </span>
                            <span class="nav-link-title"><?= Yii::t('codices', 'Collections') ?></span>
                        </a>
                    </li>
                    <li class="nav-item <?= $tab == 'series' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= Url::to(['/series/index']) ?>">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bookmarks"
                             width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                             fill="none" stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M13 7a2 2 0 0 1 2 2v12l-5 -3l-5 3v-12a2 2 0 0 1 2 -2h6z"></path>
   <path d="M9.265 4a2 2 0 0 1 1.735 -1h6a2 2 0 0 1 2 2v12l-1 -.6"></path>
</svg>
                    </span>
                            <span class="nav-link-title"><?= Yii::t('codices', 'Series') ?></span>
                        </a>
                    </li>

                    <li class="nav-item dropdown <?= in_array($tab, ['authors', 'genres', 'publishers']) ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#support-data" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tools" width="24"
                           height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                           stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M3 21h4l13 -13a1.5 1.5 0 0 0 -4 -4l-13 13v4"></path>
   <line x1="14.5" y1="5.5" x2="18.5" y2="9.5"></line>
   <polyline points="12 8 7 3 3 7 8 12"></polyline>
   <line x1="7" y1="8" x2="5.5" y2="9.5"></line>
   <polyline points="16 12 21 17 17 21 12 16"></polyline>
   <line x1="16" y1="17" x2="14.5" y2="18.5"></line>
</svg>
                    </span>
                            <span class="nav-link-title"><?= Yii::t('codices', 'Data') ?></span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= Url::to(['/authors/index']) ?>">
                                <?= Yii::t('codices', 'Authors') ?></a>
                            <a class="dropdown-item"
                               href="<?= Url::to(['/genres/index']) ?>"><?= Yii::t('codices', 'Genres') ?></a>
                            <a class="dropdown-item"
                               href="<?= Url::to(['/publishers/index']) ?>"><?= Yii::t('codices', 'Publishers') ?></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown <?= in_array($tab, ['accounts']) ? 'active' : '' ?>">
                        <a class="nav-link dropdown-toggle" href="#settings" data-bs-toggle="dropdown"
                           data-bs-auto-close="outside" role="button" aria-expanded="false">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24"
                           height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                           stroke-linecap="round" stroke-linejoin="round">
   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
   <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
   <circle cx="12" cy="12" r="3"></circle>
</svg>
                    </span>
                            <span class="nav-link-title"><?= Yii::t('codices', 'Settings') ?></span>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item"
                               href="<?= Url::to(['/accounts/index']) ?>"><?= Yii::t('codices', 'User Accounts') ?></a>
                        </div>
                    </li>
                </ul>
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <form action="#" method="get">
                        <div class="input-icon">
                    <span class="input-icon-addon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                           stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                           stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                          <circle cx="10" cy="10" r="7"/>
                          <line x1="21" y1="21" x2="15" y2="15"/></svg>
                    </span>
                            <input type="text" value="" class="form-control"
                                   placeholder="<?= Yii::t('codices', 'Search…') ?>"
                                   aria-label="Search in website">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>