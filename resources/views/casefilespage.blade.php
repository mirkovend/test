<!DOCTYPE html>
<html>
<head>
	<title>Case Files</title>
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
      });
      //NOW ANG GRID
      $("#grid").kendoGrid({
          dataSource: dataSource, //so butang nimu diri nga ang datasource or connection niya paingon sa database is kani imu datasource nga configuration
          pageable: false,
          height: 550,
          toolbar: ["create"], //create kay para mag himo siya atuomatic og form base sa imu schema
          columns: [ //fields..mao ni makita sa imu table..
              { field:"caseno",title:"Case No." },
              { field: "title", title: "Title"},
              { field: "description", title:"Description"},
              //destory and edit..para naa siya option nga mag edit or mag delete per row
              { command: ["edit", "destroy"], title: "&nbsp;", width: "250px" }],
          editable: "popup",//popup para choi..pwede pud inline ang editing..
          save: function(e) { //save nga function tawagon niya every time mag save ka og new or mag update ka og existing nga record..
            var that = this; //this refers to the grid..gi assign lang nako sa that..para magamit nako ang value inside sa scope sa ako ajax nga request
            $.ajax({ //ajax by jquery..so if ma communicate ka sa imu server pwede ka mo gamit og ajax  nga request..
                url: "http://mangtaswebapi-aguilarufino790764.codeanyapp.com/api/cases" + (e.model.id == null ? "" : "/" + e.model.id),//notice ang url mejo naa magic..tapulan man gud ko..ok..so meaning if naa ID sa imu value sa imu gi submit nga data..old na siya nga record..so update na siya..pero if null ang imu id..then new na nga record..
                type: e.model.id == null ? 'POST' : 'PUT',//if naa id then PUT kay update man.. kung wala pa ID then POST..kay new na siya nga record..create kibali..
                contentType: 'application/json',
                dataType: 'json',//data type sa imu ipasa nga record is json
                data: JSON.stringify(e.model),//so here from e.model nga javascript nga object..iya gi parse or convert into json..
                success: function (data) {
										that.refresh();//if success ang request..then i.refersh niya ang grid..so if mag refresh tawagon niya utro ang read bali nag initialize utro ang grid..
                },
                error: function (data) {
                    that.cancelRow();//if error cancel Row edit..

                }
            });
						dataSource.read();//now para pud if ever no wala ni paak ang requeset..then i.reload nako ang datasource..call nako nga function nga read
						this.refresh();///then ako i.refresh ang grid para ma update iya values
          },
          remove: function(e) {
           //remove kung mag delete..mao ni ga tawagon niya nga method sa grid if mag delete ka..
            var that = this;
            $.ajax({
                //then ajax nga request nga naa method nga DELETE..then pasa ang id sa i.delete nga row sa url..diba katong pariha sa postman?...
                url: "http://mangtaswebapi-aguilarufino790764.codeanyapp.com/api/cases/"+e.model.id,
                type: 'DELETE',
                success: function (data) {
                    that.refresh();//same

                },
                error: function (data) {
                    that.cancelRow();//same..

                }

            });
          }
      });
      // alert(JSON.stringify(dataSource.data()));
  });


</script>
	
</body>
</html>