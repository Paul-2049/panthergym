
  <?php get_template_part("template-parts/symbols/embed-global"); ?>
  <div class="w-embed">
    <style>
.navbar .menu--link-row {
  background-color: black !important;
}
.navbar {
  background-color: transparent !important;
  color: black;
  transition-property: background-color;
  transition-duration: 200ms;
  transition-timing-function: ease;
}
</style>
  </div>
  <?php get_template_part("template-parts/symbols/navbar"); ?>
  <div class="section is--checkout wf-section">
    <div class="container--1248">
      <h1 class="heading--120" data-text="t5f75b166"><?php echo _u('t5f75b166','text'); ?></h1>
      <?php udesly_wc_checkout() ?>
    </div>
  </div>
  <?php get_template_part("template-parts/symbols/footer"); ?>
  
  