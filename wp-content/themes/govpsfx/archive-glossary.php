<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package govpsfx
 */

get_header();
?>
<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body">
			<div class="page__title h1">
				<h1><?php esc_html_e('Глоссарий форекс терминов', 'govpsfx') ?></h1>
			</div>
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/search-list/search-list.css?ver=1617394691974">
			<div class="search-list">
				<div class="search-list__filters row">
					<div class="search-list__filter">
						<div class="search-list__filter-title"><?php esc_html_e('Поиск по слову', 'govpsfx') ?></div>
						<div class="search-list__filter-wrap">
							<form action="<?= site_url() ?>" method="GET" class="search-list__filter-search">
								<input name="post_type" type="hidden" value="glossary">
								<div class="search-list__filter-input input">
									<div class="input__wrap"><input class="input__area" type="text" name="s"></div>
								</div>
								<button class="search-list__filter-btn btn --h-icon-yellow">
									<svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M14.0003 13.668L12.0123 11.68L13.9163 9.776L15.2043 8.684L15.1763 8.572L12.7963 8.712H0.560328V5.744H12.7963L15.1763 5.884L15.2043 5.772L13.9163 4.68L12.0123 2.776L14.0003 0.787998L20.4403 7.228L14.0003 13.668Z" fill="#FFB800"></path>
									</svg>
								</button>
							</form>
						</div>
					</div>
					<div class="search-list__filter">
						<div class="search-list__filter-title"><?php esc_html_e('Поиск по букве', 'govpsfx') ?></div>
						<div class="search-list__filter-wrap search-list__letters">
							<ul>
							<?php foreach (range(chr(0xC0), chr(0xDF)) as $b) : ?>
								<li><a href="?w=<?= iconv('CP1251', 'UTF-8', $b); ?>" class="content__search-letter"><?= iconv('CP1251', 'UTF-8', $b); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="search-list__list">
					<?php 
						$word = $_GET['w'];
						$post_type = 'glossary';

						$glossarys = get_posts([
							'post_type' => $post_type,
							'numberposts' => 5,
							'order' => 'ASC',
						]);

					if (!$word) :
					foreach ($glossarys as $post) :
						// print_r($post);
						get_template_part('parts/search-item');
					endforeach;
					else :
						if ($gsearch = glossary_search($glossarys, $word)) :
							foreach ($gsearch as $post) :
								// print_r($post);
								get_template_part('parts/search-item');
						endforeach;
						else :
							echo '<div class="search-list__false h4">'.esc_html('Пока здесь нет терминов, но мы над этим работаем', 'govpsfx').'</div>';
						endif;
					endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="page__bg-37 bg"><img src="<?= TEMP() ?>_/uploads/scheme-search-1.png" alt=""></div>
	<div class="page__bg-38 bg"><img src="<?= TEMP() ?>_/uploads/scheme-search-2.png" alt=""></div>
</div>
<?php
get_footer();
