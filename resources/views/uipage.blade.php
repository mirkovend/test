<!DOCTYPE html>
<html>
<head>
	<title>Simple View</title>
	<link href="styles/kendo.common.min.css" rel="stylesheet">
    <link href="styles/kendo.rtl.min.css" rel="stylesheet">
    <link href="styles/kendo.default.min.css" rel="stylesheet">
    <link href="styles/kendo.default.mobile.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/kendo.all.min.js"></script>
</head>
<body>
<div id="grid"></div>

<script>
  
  $(document).ready(function () {
      var dataSource = new kendo.data.DataSource({
          pageSize: 20,
          transport: {
            read: {
              url:"http://mangtaswebapi-aguilarufino790764.codeanyapp.com/api/cases/",
              type: "GET",
              dataType: "json",
            }
            // ,
            // create: {
            //   url:"http://mangtaswebapi.dev/api/cases/",
            //   type: "POST",
            //   dataType: "json",
            // },
            // udpate: {
            //     url:"http://mangtaswebapi.dev/api/cases/",
            //     type: "PUT",
            //     dataType: "json",
            // }
            // ,
            // parameterMap: function(options, operation) {
            //     if (operation !== "udpate" && options.models) {
            //         alert(kendo.stringify(options.models));
            //       return {models: kendo.stringify(options.models)};
            //     }
            // }
          },
          schema: {
            data: "cases",
            model: {
             id: "id",
             fields: {
                id: { type:"number",editable: false, nullable: true },
                caseno: { validation: { required: true } },
                title: { validation: { required: true } },
                description: { type: "string" }
             }
            }
          }
          // parameterMap   : function (options) {
          //   return JSON.stringify(options);
          // }
      });

      $("#grid").kendoGrid({
          dataSource: dataSource,
          pageable: false,
          height: 550,
          toolbar: ["create"],
          columns: [
              { field:"caseno",title:"Case No." },
              { field: "title", title: "Title"},
              { field: "description", title:"Description"},
              { command: ["edit", "destroy"], title: "&nbsp;", width: "250px" }],
          editable: "popup",
          save: function(e) {
        
            var that = this;
            $.ajax({
                url: "http://mangtaswebapi-aguilarufino790764.codeanyapp.com/api/cases" + (e.model.id == null ? "" : "/" + e.model.id),
                type: e.model.id == null ? 'POST' : 'PUT',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify(e.model),
                success: function (data) {
                    that.refresh();

                },
                error: function (data) {
                    that.cancelRow();

                }

            });
          },
          remove: function(e) {
           
            var that = this;
            $.ajax({
                url: "http://mangtaswebapi-aguilarufino790764.codeanyapp.com/api/cases/"+e.model.id,
                type: 'DELETE',
                success: function (data) {
                    that.refresh();

                },
                error: function (data) {
                    that.cancelRow();

                }

            });
          }
      });
      // alert(JSON.stringify(dataSource.data()));
  });


</script>
	
</body>
</html>