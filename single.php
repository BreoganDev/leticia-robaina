<?php
/**
 * SINGLE.PHP - TEMPLATE PARA POSTS INDIVIDUALES
 * Leticia Robaina WordPress Theme
 */

get_header(); ?>

<main class="main-content single-post">
    
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="layout-row hero-image">
                    <div class="block block-featured block-destacado background-dark" style="height: 60vh;">
                        <div class="block-background-image">
                            <?php the_post_thumbnail('full', array('class' => 'block-picture')); ?>
                        </div>
                        <div class="container">
                            <div class="block-featured-content" style="width: 80%; margin: 0 auto; text-align: center;">
                                <h1 class="block-title"><?php the_title(); ?></h1>
                                <div class="entry-meta">
                                    <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                    
                                    <?php if (get_the_author()) : ?>
                                        <span class="byline">
                                            por <?php echo get_the_author(); ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if (has_category()) : ?>
                                        <span class="categories">
                                            en <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="layout-row header-section background-light pt100 pb100">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h1 class="page-title"><?php the_title(); ?></h1>
                                <div class="entry-meta">
                                    <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                    
                                    <?php if (get_the_author()) : ?>
                                        <span class="byline">
                                            por <?php echo get_the_author(); ?>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if (has_category()) : ?>
                                        <span class="categories">
                                            en <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <div class="layout-row content-section background-white pt100 pb100">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="entry-content rtf-content">
                                <?php the_content(); ?>
                            </div>
                            
                            <?php if (has_tag()) : ?>
                                <div class="entry-tags">
                                    <h5>Etiquetas:</h5>
                                    <?php the_tags('<span class="tag">', '</span><span class="tag">', '</span>'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-navigation">
                                <?php
                                $prev_post = get_previous_post();
                                $next_post = get_next_post();
                                ?>
                                
                                <div class="nav-links">
                                    <?php if ($prev_post) : ?>
                                        <div class="nav-previous">
                                            <a href="<?php echo get_permalink($prev_post->ID); ?>" rel="prev">
                                                <span class="meta-nav">← Anterior</span>
                                                <span class="post-title"><?php echo get_the_title($prev_post->ID); ?></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($next_post) : ?>
                                        <div class="nav-next">
                                            <a href="<?php echo get_permalink($next_post->ID); ?>" rel="next">
                                                <span class="meta-nav">Siguiente →</span>
                                                <span class="post-title"><?php echo get_the_title($next_post->ID); ?></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <?php
                            // Mostrar comentarios si están habilitados
                            if (comments_open() || get_comments_number()) {
                                comments_template();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
        </article>
        
    <?php endwhile; ?>
    
</main>

<style>
/* Estilos específicos para single post */
.single-post .entry-meta {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.1rem;
    margin-top: 1rem;
}

.single-post .entry-meta span {
    margin-right: 1rem;
}

.single-post .rtf-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.single-post .rtf-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
}

.single-post .entry-tags {
    margin: 3rem 0;
    padding: 2rem 0;
    border-top: 1px solid #eee;
}

.single-post .tag {
    display: inline-block;
    background: #f8f9fa;
    padding: 0.3rem 0.8rem;
    margin: 0.2rem;
    border-radius: 15px;
    font-size: 0.9rem;
    text-decoration: none;
    color: #666;
}

.single-post .post-navigation {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #eee;
}

.single-post .nav-links {
    display: flex;
    justify-content: space-between;
    gap: 2rem;
}

.single-post .nav-links > div {
    flex: 1;
}

.single-post .nav-next {
    text-align: right;
}

.single-post .nav-links a {
    display: block;
    text-decoration: none;
    color: #333;
    padding: 1rem;
    border: 1px solid #eee;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.single-post .nav-links a:hover {
    background: #f8f9fa;
    border-color: #ddd;
}

.single-post .meta-nav {
    display: block;
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.single-post .post-title {
    display: block;
    font-weight: 600;
    color: #333;
}

@media (max-width: 768px) {
    .single-post .nav-links {
        flex-direction: column;
    }
    
    .single-post .nav-next {
        text-align: left;
    }
    
    .single-post .rtf-content {
        font-size: 1rem;
    }
}
</style>

<?php get_footer(); ?>