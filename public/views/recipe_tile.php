<link rel="stylesheet" type="text/css" href="public/css/tile3.css">


<!--Order - kolejność dla przepisów w przypadku wyświetlania kafelków
    na stronie głównej.
    Size - rozmiary kafelków. Zaimplementowane w tile.css to:
    size1 - duży kafelek na stronie głównej
    size2 - mały kafelek na stronie głównej
    size3 - kafelek na stronie search
    -->

<a href="recipe?title=<?= $recipe->getTitle(); ?>" class="recipe-tile-container <?= $order ?>">
    <div class="recipe-tile <?= $size ?>">
        <div class="recipe-tile-img">
            <img src="public/uploads/<?= $recipe->getImage(); ?>">
        </div>
        <div class="recipe-tile-text">
            <p><?= $recipe->getTitle(); ?></p>
        </div>
    </div>
</a>