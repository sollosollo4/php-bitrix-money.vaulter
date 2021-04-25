    <footer>
    </footer>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/notiflix-2.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script src="<?=SITE_TEMPLATE_PATH?>/assets/js/main.js"></script>
    <script>
    $(document).ready(function(){ 
      loadChart();
      
      $("#load_vaulters").on("click", function(event){
        $.ajax({
          type: 'POST',
          url: "/api/",
          data: {type: "back", function: "load"},
          dataType: 'json',
          success: function(data) {
            Notiflix.Report.Success("Успешно", "Данные успешно загружены.", "Ok");
          }
        });  
      });

      $("#update_vaulters").on("click", function(event){
        Notiflix.Report.Success("Успешно", "Данные успешно обновены.", "Ok");
        loadChart();
      });

    });

    function loadChart() {
      $.ajax({
        type: 'POST',
        url: "/api/",
        data: {type: "front", function: "get_all_data"},
        dataType: 'json',
        success: function(data)
        {
          Notiflix.Notify.Success('Графики успешно загружены');
          console.log(data);

          $("#vaulter-table-old").empty();
          $("#vaulter-table-fresh").empty();

          if(!data.FRESH)
            return false;


            // for fresh 
          var labels = data.FRESH.map(function(value, index){
            return value['FULLTIME']
          });

          var dollarValues = data.FRESH.map(function(value, index){
            return value['DOLLAR'];
          });

          var euroValues = data.FRESH.map(function(value, index){
            return value['EURO'];
          });

          var index = 0;
          data.FRESH.forEach(function(elem){
            
            $("#vaulter-table-fresh").append(
              `<tr>
               <td>${index}</td>
               <td>$ ${elem.DOLLAR}, € ${elem.EURO}</td>
               <td>${elem.NAME}</td>
               <td>${elem.DATE}</td>
               <td>${elem.TIME}</td>
               <td>fresh</td>
              </tr>`
            );
            index++;
          });

          var ctx = document.getElementById("myChartFresh");
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: labels,
              datasets: [
                {
                  label: "$",
                  data: dollarValues,
                  lineTension: 0,
                  backgroundColor: 'transparent',
                  borderColor: '#d43f00',
                  borderWidth: 4,
                  pointBackgroundColor: '#ffffff'
                },
                {
                  label: "€",
                  data: euroValues,
                  lineTension: 0,
                  backgroundColor: 'transparent',
                  borderColor: '#1ee1e8',
                  borderWidth: 4,
                  pointBackgroundColor: '#ffffff'
                },
            ]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                }]
              },
              legend: {
                display: true,
              }
            }
          });

          if(!data.OLD)
            return false;

            // for old
          var labels = data.OLD.map(function(value, index){
            return value['FULLTIME']
          });

          var dollarValues = data.OLD.map(function(value, index){
            return value['DOLLAR']
          });

          var euroValues = data.OLD.map(function(value, index){
            return value['EURO']
          });

          var index = 0;
          data.OLD.forEach(function(elem){
            
            $("#vaulter-table-old").append(
              `<tr>
               <td>${index}</td>
               <td>$ ${elem.DOLLAR}, € ${elem.EURO}</td>
               <td>${elem.NAME}</td>
               <td>${elem.DATE}</td>
               <td>${elem.TIME}</td>
               <td>old</td>
              </tr>`
            );
            index++;
          });

          var ctx = document.getElementById("myChartOld");
          var myChart = new Chart(ctx, {
            type: 'line',
            data: {
              labels: labels,
              datasets: [
                {
                  label: "$",
                  data: dollarValues,
                  lineTension: 0,
                  backgroundColor: 'transparent',
                  borderColor: '#d43f00',
                  borderWidth: 4,
                  pointBackgroundColor: '#ffffff'
                },
                {
                  label: "€",
                  data: euroValues,
                  lineTension: 0,
                  backgroundColor: 'transparent',
                  borderColor: '#1ee1e8',
                  borderWidth: 4,
                  pointBackgroundColor: '#ffffff'
                },
            ]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                }]
              },
              legend: {
                display: true,
              }
            }
          });
        }
      });      
    }
    </script>
</body>
</html>