/**
 * @file
 * Drupal Views Personalizer plugin.
 */

 (function ($, Drupal) {

  Drupal.behaviors.views_personalizer = {
    initialized: false,
    detach: function() {
      Drupal.behaviors.views_personalizer.initialized = false;
    },
    attach: function (context, settings) {
      $(document).ready(function(){
        if ( ! $.fn.DataTable.fnIsDataTable( 'table.personalized-view' ) ) {
          $('table.personalized-view').DataTable({
            "searching": false, 
            "info": false,
            "bSort": false,
            "dom": "Rlfrtip",
            "paging": false,
            "fnDrawCallback": function(e) {
              // Called when we redraw the table.
            }
          });

          $('.views-preset-column-select').multiselect({
            columns: 2,
            placeholder: Drupal.t('Select Columns'),
            search: true,
            onControlClose: function(e) {
              // called when a user closes the multiselect window.
              console.log(e);
              
            }
          });
        }
        
      });
    }
  };


 })(jQuery, Drupal);