$.ajax({
		url: "http://localhost/userdetails/ajax/data.php",
		method: "GET",
		success: function(result)
		{ 
                     alert(result);
                   
                     var myJSON = JSON.stringify(result);
                     alert(myJSON);
                     return false;
                     console.log(result);
                     
                     /*alert(result);
                     return;*/
             
                            var scheduled_timestamp   = [];
                        
                            var total   = [];
                         
                         for(var i in result){
                           
                                scheduled_timestamp.push("Date="+result[i].scheduled_timestamp);

                                total.push(result[i].total);
                           }
                                var chartdata = {
                                labels:scheduled_timestamp,
                                datasets:[
                                    {
                                        label: 'Notification',
                                        backgroundColor: '#49e2ff',
                                        borderColor: '#46d5f1',
                                        hoverBackgroundColor: '#5cb85c',
                                        hoverBorderColor: '#CCCCCC',
                                        data: total
                                    }
                                ]
                            };
                            
                                    
                             var graphTarget = $("#graphCanvas");

                             var barGraph = new Chart(graphTarget,{
                                      type: 'bar',

                                    data: chartdata,
                             options: {
                                       scales: {
                                                xAxes: [{
                                                    stacked: true
                                                }],
                                                yAxes: [{
                                                    stacked: true
                                                }]
                                          },
                                         
                              }

                 });
                
           
		},
       error: function(result)
        {
            console.log("Checking Error:");
            console.log(result);
        }
		
	});
