<form action="<?php bloginfo('url'); ?>/" method="get" accept-charset="utf-8" id="searchform" role="search">
    <div class="input-field">
        <input id="s" name="s" type="search" value="<?php the_search_query(); ?>" required>
        <label for="s"><i class="material-icons">search</i>Pesquisar</label>
        <i class="material-icons">close</i>
    </div>
</form>