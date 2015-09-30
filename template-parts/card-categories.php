<div class="card sidebar">
    <h2>Categories</h2>
    <p>Browse posts from our other categories:</p>
    <ul>
        <?php foreach (get_categories() as $category): ?>
            <?php if ($category->slug != 'uncategorized'): ?>
                <li class="slidecard">
                    <a href="<?= get_category_link($category->cat_ID) ?>"><?= $category->name ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>