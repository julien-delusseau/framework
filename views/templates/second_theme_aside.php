<?php if(rtrim($_SERVER['REQUEST_URI'], '/') === '/blog/pages/contact'): ?>
    <aside>
        <div class="widget">
            <h4>Restons en contact</h4>
            <ul>
                <li><label><strong>Téléphone : </strong></label>
                    <p>
                        07 69 01 84 47
                    </p>
                </li>
                <li><label><strong>Email : </strong></label>
                    <p>
                        <?= EMAIL ?>
                    </p>
                </li>
                <li><label><strong>Adresse : </strong></label>
                    <p>
                        33000 Bordeaux
                    </p>
                </li>
            </ul>
        </div>
        <div class="widget">
            <h4>Réseaux sociaux</h4>
            <ul class="social-links">
                <?php if(!empty(GITHUB)): ?>
                    <li><a href="<?= GITHUB ?>" target="_blank" title="Github"><i class="icon-rounded icon-32 icon-github"></i></a></li>
                <?php endif; ?>
                <?php if(!empty(LINKEDIN)): ?>
                    <li><a href="<?= LINKEDIN ?>" target="_blank" title="Linkedin"><i class="icon-rounded icon-32 icon-linkedin"></i></a></li>
                <?php endif; ?>
                <?php if(!empty(TWITTER)): ?>
                    <li><a href="<?= TWITTER ?>" target="_blank" title="Twitter"><i class="icon-rounded icon-32 icon-twitter"></i></a></li>
                <?php endif; ?>
                <?php if(!empty(FACEBOOK)): ?>
                    <li><a href="<?= FACEBOOK ?>" target="_blank" title="Facebook"><i class="icon-rounded icon-32 icon-facebook"></i></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </aside>
<?php else: ?>
    <aside>
        <div class="widget">
            <h4>Catégories</h4>
            <ul class="cat">
                <?php foreach (getCategories() as $category): ?>
                    <li>
                        <a href="<?= URL . '/category/filter/' . $category->name ?>">
                            <?= ucwords($category->name) ?> (<?= $category->count ?>)
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="widget">
            <h4>Articles récents</h4>
            <ul class="recent-posts">
                <?php foreach (getLatestPosts() as $post): ?>
                    <li>
                        <a href="<?= URL . '/' . $post->slug ?>"><?= $post->title ?></a>
                        <div class="clear"></div>
                        <span class="date"><i class="fa-solid fa-calendar-days"></i> <?= $post->date ?></span>
                        <span class="comment"><i class="fa-solid fa-comment"></i> <?= $post->comments ?> commentaire(s)</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>
<?php endif; ?>