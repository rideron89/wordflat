<div class="card sidebar">
    <h2>Categories</h2>
    <p>Browse posts from our other categories:</p>
    <ul>
        <?php foreach (get_categories() as $category): ?>
            <?php if ($category->slug != 'uncategorized'): ?>
                <li class="slidecard">
                    <a href=""><?= $category->name ?></a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>