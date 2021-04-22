var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            <?php
                
                //asn 28683
                $grapheparASN1=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='28683' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN1->execute();
                while($resGrapheparASN1= $grapheparASN1->fetch()){
                    $data[] = $resGrapheparASN1['moyenneDownSpeed'];
                }
                //asn 37424
                $grapheparASN2=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='37424' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN2->execute();
                while($resGrapheparASN2= $grapheparASN2->fetch()){
                    $data2[] = $resGrapheparASN2['moyenneDownSpeed'];
                }
                //asn 37136
                $grapheparASN3=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='37136' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN3->execute();
                while($resGrapheparASN3= $grapheparASN3->fetch()){
                    $data3[] = $resGrapheparASN3['moyenneDownSpeed'];
                }
                //asn 328228
                $grapheparASN4=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='328228' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN4->execute();
                while($resGrapheparASN4= $grapheparASN4->fetch()){
                    $data4[] = $resGrapheparASN4['moyenneDownSpeed'];
                }
                //asn 37090
                $grapheparASN5=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='37090' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN5->execute();
                while($resGrapheparASN5= $grapheparASN5->fetch()){
                    $data5[] = $resGrapheparASN5['moyenneDownSpeed'];
                }
                //asn 37292
                $grapheparASN6=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='37292' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $grapheparASN6->execute();
                while($resGrapheparASN6= $grapheparASN6->fetch()){
                    $data6[] = $resGrapheparASN6['moyenneDownSpeed'];
                }
                //les semaines
                $qLabel=$connexion->prepare("SELECT * FROM (SELECT AVG(debit) AS moyenneDownSpeed, Week(date) AS Semaine, asn FROM downloads WHERE asn='37292' GROUP BY Week(date),asn ORDER BY Week(date) DESC LIMIT 10) tmp ORDER BY Semaine");
                $qLabel->execute();
                while($resLabel= $qLabel->fetch()){
                    $dataL[] = $resLabel['Semaine'];
                }
            ?>     
            data: {
                labels: <?=json_encode($dataL);?>,
                datasets: [
                    
                    {
                        label: 'AS28683',
                        backgroundColor: 'rgba(10, 99, 132,0.5)',
                        borderColor: 'rgb(10, 99, 132)',
                        data: <?=json_encode($data);?>
                    },
                    {
                        label: 'AS37424',
                        backgroundColor: 'rgba(10, 209, 132,0.5)',
                        borderColor: 'rgb(10, 209, 132)',
                        data: <?=json_encode($data2);?>
                    },
                    {
                        label: 'AS37136',
                        backgroundColor: 'rgba(10, 209, 13,0.5)',
                        borderColor: 'rgb(10, 209, 13)',
                        data: <?=json_encode($data3);?>
                    },
                    {
                        label: 'AS328228',
                        backgroundColor: 'rgba(10, 209, 229,0.5)',
                        borderColor: 'rgb(10, 209, 229)',
                        data: <?=json_encode($data4);?>
                    },
                    {
                        label: 'AS37090',
                        backgroundColor: 'rgba(100, 19, 229,0.5)',
                        borderColor: 'rgb(100, 19, 229)',
                        data: <?=json_encode($data5);?>
                    },
                    {
                        label: 'AS37292',
                        backgroundColor: 'rgba(200, 254, 5,0.5)',
                        borderColor: 'rgb(200, 254, 5)',
                        data: <?=json_encode($data6);?>
                    }
                    //fin boucle
                    
                ]
                
            },
            
            // Configuration options go here
            options: {}
        });
        