if (!window.ImportQueue) window.ImportQueue = {};

window.ImportQueue = {
  activeTable: null,
  openTable: null,
  archivedTable: null,

  init: function() {
    this.setupDatatables();
    this.setupTabEvents();
  },

  setupDatatables: function() {
    var _this = this;

    this.openTable = $('#open-table').DataTable({
      ajax: {
        url: '/admin/import_queue/imports/open',
        data: _this.buildSearchParams
      },

      columns: [{
        data: 'firstname',
        defaultContent: ''
      }, {
        data: 'lastname',
        defaultContent: ''
      }, {
        data: 'ssn',
        defaultContent: ''
      }, {
        data: 'extra_data',
        defaultContent: ''
      }]
    });

    this.activeTable = this.openTable;
  },

  setupTabEvents: function() {
    var _this = this;

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(event) {
      var $activeTabContent = $(event.target.hash),
        $activeTabContentTable = $activeTabContent.find('table'),
        selectedStatus = event.target.text.toLowerCase();

      if (!$.fn.DataTable.isDataTable($activeTabContentTable)) {
        if (selectedStatus === 'archived') {
          _this.archivedTable = $activeTabContentTable.DataTable({
            ajax: {
              url: '/admin/import_queue/imports/archived',
              data: _this.buildSearchParams
            },

            columns: [{
              data: 'firstname',
              defaultContent: ''
            }, {
              data: 'lastname',
              defaultContent: ''
            }, {
              data: 'ssn',
              defaultContent: ''
            }, {
              data: 'extra_data',
              defaultContent: ''
            }, {
              data: 'processed_at',
              defaultContent: ''
            }],

            columnDefs: [{
              targets: 4,

              render: function (data, type, full, meta) {
                return moment(data).format('MM/DD/YYYY h:mma');
              }
            }]
          });

          _this.activeTable = _this.archivedTable;
        }
      }
    });
  }
};

$(function() {
  window.ImportQueue.init();
});