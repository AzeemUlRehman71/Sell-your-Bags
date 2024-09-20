/**
 * DataTables Basic
 */

 $(function () {
  'use strict';

  var dt_basic_table = $('.datatables-basic'),
      dt_basic = $('.datatables'),
    dt_date_table = $('.dt-date'),
    dt_complex_header_table = $('.dt-complex-header'),
    dt_row_grouping_table = $('.dt-row-grouping'),
    dt_multilingual_table = $('.dt-multilingual'),
    assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_basic_table.length) {
    var dt_basic = dt_basic_table.DataTable({
      //gul here below code is not working for enabling search for hidden columns
      //so on index page I have used display none for Email column so that we can search on index page
      //via email as well
      "columnDefs": [
        { "searchable": true,"visible":true }
      ],
      //ordering in descing order by PO_number //Gul

      order: [[0, 'desc']],
     
      dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      //Gul here
      //menu items length here 
      displayLength: 20,
      lengthMenu: [20, 30, 40, 60, 75, 100],
      //this below as well not working so commented
      //searchable:true,

      // columnDefs: [{
      //   targets: 0,
      //   searchable: true,
      //   visible: false
      //      }],
         
     
      buttons: [
        {
          
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
              className: 'dropdown-item'
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
              className: 'dropdown-item'
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              
            //   customize: function (xlsx) {
            //     console.log(xlsx);
            //     var sheet = xlsx.xl.worksheets['sheet1.xml'];
            //     var downrows = 3;
            //     var clRow = $('row', sheet);
            //     //update Row
            //     clRow.each(function () {
            //         var attr = $(this).attr('r');
            //         var ind = parseInt(attr);
            //         ind = ind + downrows;
            //         $(this).attr("r",ind);
            //     });
         
            //     // Update  row > c
            //     $('row c ', sheet).each(function () {
            //         var attr = $(this).attr('r');
            //         var pre = attr.substring(0, 1);
            //         var ind = parseInt(attr.substring(1, attr.length));
            //         ind = ind + downrows;
            //         $(this).attr("r", pre + ind);
            //     });
         
            //     function Addrow(index,data) {
            //       var  msg='<row r="'+index+'">'
            //         for(let i=0;i<data.length;i++){
            //             var key=data[i].k;
            //             var value=data[i].v;
            //             msg += '<c t="inlineStr" r="' + key + index + '" s="42">';
            //             msg += '<is>';
            //             msg +=  '<t>'+value+'</t>';
            //             msg+=  '</is>';
            //             msg+='</c>';
            //         }
            //         msg += '</row>';
            //         return msg;
            //     }
         
            //     //insert
            //    // var r1 = Addrow(1, [{ k: 'A', v: 'ColA' }, { k: 'B', v: '' }, { k: 'C', v: '' }]);
            //     var r1 = Addrow(1, [{ k: 'A', v: 'ColA' }]);
            //     var r2 = Addrow(2, [{ k: 'A', v: '' }, { k: 'B', v: 'ColB' }, { k: 'C', v: '' }]);
            //     var r3 = Addrow(3, [{ k: 'A', v: '' }, { k: 'B', v: '' }, { k: 'C', v: 'ColC' }]);
                
            //     sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2+ r3+ sheet.childNodes[0].childNodes[1].innerHTML;
            // },
            exportOptions: {
              columns: [1,4,5,6 ],
              modifier: {
              page: 'all'
              },
                  format: {
                      header: function ( data, columnIdx ) {
                          if(columnIdx==1){
                          return 'Location ID for Warehouse(s), Store(s) and other sales locations (Can be Customer assigned ID or  Apple assigned ID)';
                          }
                          else if(columnIdx==4){
                          return 'Part Number';

                          }
                          else if(columnIdx==5){
                            return 'Units sold through and shipped from warehouse(s) or Points Of Sale (PoS) to the end customer (Gross Quantity if "Sell Thru Returned Qty" is reported, otherwise Net Quantity)';
  
                            }
                            else if(columnIdx==6){
                              return 'Inventory units available for sale at warehouse(s) and  Points of Sale (PoS) (with no payment/deposit from customer)';
    
                              }
                           
                          else{
                          return data;
                          }
                      }
                  },
             
                },
               className: 'dropdown-item',
               
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item'
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
              className: 'dropdown-item'
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIdx +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
          }
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      },
      initComplete: function () {
         $("div.dataTables_filter input").focus();
      }
    });
  }


  // only datatables
    if (dt_basic.length) {
        var dt_basic = dt_basic.DataTable({
            dom: '<"card-header border-bottom p-1"><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        });
    }
});
