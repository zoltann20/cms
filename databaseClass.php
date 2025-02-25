<?php
    class db 
    {
        public $version; // az osztály verziószáma
        private $dbhost; // az adatbázis kiszolgáló címe
        private $dbname; // az adatbázis neve
        private $dbuser; // az adatbázis felhasználó neve
        private $dbpass; // az adatbázis felhasználó jelszava
        private $connection; // az adatbázis kapcsolat
        public $queryresult; // az SQL lekérdezések eredménye
        public $querycount = 0; // az elvégzett lekérdezések száma
        private $debug = false; // hibakeresési mód
        
        public function __construct($host, $name, $user, $pass) // az osztály konstruktora
        {
            // az átvett paramétereket átadjuk az objektum megfelelő attributumainak
            $this->dbhost = $host; 
            $this->dbname = $name;
            $this->dbuser = $user;
            $this->dbpass = base64_decode($pass);

            // az objektumunk connection attributuma egy új mysqli objektum lesz
            $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);

            // ha nem jön létre a mysqli objektum (nem épül fel az adatbázis kapcsolat), akkor kiírjuk a hibaüzenetet
            if ($this->connection->connect_error)
            {
                die("Hiba történt az adatbázis kapcsolat felépítése közben! (" .$this->connection->connect_error.")");
            }

            // beállítjuk a karakterkódolást unicode-ra
            $this->connection->set_charset("utf8");
            // beállítjuk a verziószámot
            $this->version = "v2.20250222";
        }

        public function __destruct() // az osztály destruktora
        {
            // egyenlőre nincs funkciója
        }

        // az SQL lekérdezésekhez szükséges metódus
        public function DBquery($sql)
        {
            // lefuttatjuk a mysql osztály query metódusát és a kapott eredményeket a queryresult attributumban tároljuk
            if ($this->queryresult = $this->connection->query($sql))
            {
                // ha sikeres a lekérdezés, akkor a querycount változót növeljük
                // echo 'Sikeres lekérdezés!';
                $this->querycount++;
                if ($this->debug)
                {
                    $this->showMessage($sql,'primary');
                }
            }
            else
            {
                // ha nem sikerül lefuttatni a lekérdezést, akkor kiíratjuk a hibaüzenetet
                die('Hiba az adatbázis lekérdezés futtatása során! ('.$this->connection->error.')
                <div class="alert alert-warning">'.$sql.'</div>');
            }
            // visszaadjuk az eredményeket
            return $this->queryresult;
        }

        // lekérdezésben szereplő rekodrok kigyűjtése 
        public function fetchAll()
        {
            $result = array();
            foreach($this->queryresult as $rekord)
            {
                $result[] = $rekord;
            }
            return $result;
        }

        // egyetlen rekord kigyűjtése
        public function fetchOne()
        {
            foreach($this->queryresult as $rekord)
            {
                $result = $rekord;
            }
            return $result;            
        }

        // a lekérdezésben szereplő rekordok száma
        public function numRows()
        {
            return $this->queryresult->num_rows;
        }

        // a lekérdezésben szereplő mezők száma
        public function numFields()
        {
            return $this->queryresult->field_count;
        }

        // a lekérdezésben szereplő utolsó ID (auto increment) mező értéke
        public function lastID()
        {
            return $this->connection->insert_id;
        }

        // a lekérdezésben szereplő következő ID (auto increment) mező értéke
        public function nextID()
        {
            return $this->connection->insert_id+1;
        }

        // dinamikus űrlap
        public function toForm($param)
        {
          
            $input_elements = array();
            $method = 'POST';
            $enctype = '';

            // kiszedjük a sortöréseket
            $param = trim(preg_replace('/\s\s+/', '', $param));

            $params = explode(';', $param);
            foreach($params as $value)
            {
                $tags = explode('|', $value);

                if (!isset($tags[2])){ $tags[2] = '';}
                if (!isset($tags[3])){ $tags[3] = '';}
                if (!isset($tags[4])){ $tags[4] = '';}
                if (!isset($tags[5])){ $tags[5] = '';}
                

                switch($tags[0])
                {
                    case 'name': {
                        $title = '<h4 class="animated slideInDown faster">'.$tags[1].'</h4><hr class="animated zoomIn">';
                        break;
                    }
                    case 'action': {
                        if ($tags[1] == 'index')
                        {
                            $action = 'index.php';
                        }
                        else
                        {
                            $action = 'index.php?pg='.base64_encode($tags[1]);
                        }
                        break;
                    }
                    case 'method':{
                        $method = $tags[1];
                        break;
                    }
                    case 'label' : {
                        $input_elements[] = '<label for="'.$tags[1].'">'.$tags[2].'</label>';
                        break;
                    }
                    case 'text' : {
                        $input_elements[] = '<input type="text" name="'.$tags[1].'" placeholder="'.$tags[2].'" class="form-control" '.$tags[3].'>';
                        break;
                    }
                    case 'textarea' : {
                        $input_elements[] = '<textarea name="'.$tags[1].'" class="form-control '.$tags[3].'">'.$tags[2].'</textarea>';
                        break;
                    }
                    case 'email' : {
                        $input_elements[] = '<input type="email" name="'.$tags[1].'" placeholder="'.$tags[2].'" class="form-control" '.$tags[3].'>';
                        break;
                    }
                    case 'password' : {
                        $input_elements[] = '<input type="password" name="'.$tags[1].'" placeholder="'.$tags[2].'" class="form-control">';
                        break;
                    }
                    case 'button' : {
                        $input_elements[] = '<input type="button" name="'.$tags[1].'" value="'.$tags[2].'" class="btn btn-secondary">';
                        break;
                    }
                    case 'submit' : {
                        $input_elements[] = '<input type="submit" name="'.$tags[1].'" value="'.$tags[2].'" class="btn btn-secondary">';
                        break;
                    }
                    case 'checkbox' : {
                        $input_elements[] = '<input type="checkbox" name="'.$tags[1].'" '.$tags[3].'> '.$tags[2];
                        break;
                    }
                    case 'radio' : {
                        $input_elements[] = '<input type="radio" name="'.$tags[1].'" '.$tags[3].'> '.$tags[2];
                        break;
                    }
                    case 'number' : {
                        $input_elements[] = '<input type="number" name="'.$tags[1].'" class="form-control" '.$tags[3].'>';
                        break;
                    }
                    case 'date' : {
                        $input_elements[] = '<input type="date" name="'.$tags[1].'" class="form-control" '.$tags[3].'>';
                        break;
                    }
                    case 'select' : {

                        $input_elements[] = $this->toSelect($tags[1], $tags[2], $tags[3], $tags[4], $tags[5]);
                        
                        break;
                    }
                    case 'file' : {

                        $input_elements[] = '<input type="file" name="'.$tags[1].'" class="form-control" accept="*/*">';
                        $enctype = 'enctype="multipart/form-data"';
                        break;
                    }
                }
            }
            echo $title.'<form method="'.$method.'" action="'.$action.'" '.$enctype.' class="animated fadeIn">';
            foreach($input_elements as $element)
            {
                echo '<div class="form-group">'.$element.'</div>';
            }
            echo '</form>';
        }

        // a lekérdezés adatainak megjelenítése egy HTML táblázatban
        public function toTable($param)
        {
            $fields = array();
            $fields = $this->queryresult->fetch_fields();
            $fieldcount = $this->connection->field_count;
            $rekordcount = $this->numRows();
            $tablename = $fields[0]->table;
            $originaltablename = $fields[0]->orgtable;
            $primary_key = $this->getPrimaryKey($fields);
            $SetFlagFieldName = $this->getSetFlag($fields);
            
            $actions = array();
            if (!empty($param))
            {
                $actions = explode("|", $param);
            }
            
            echo '
            <h4>'.ucfirst($tablename).' listája</h4>
            <hr>';
            if (!empty($actions))
            {
                if(in_array('c', $actions))
                {
                    echo '<a href="index.php?pg='.base64_encode($originaltablename.'_new').'" title="Új rekord felvétel" class="btn btn-secondary">Új rekord felvétel</a>';
                }
            }
            echo '<table id="myTable" class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>';
                    foreach($fields as $field)
                    {
                        if ($field->name[0] == '.')
                        {
                            $cl = 'collapse';
                        }
                        else
                        {
                            $cl = '';
                        }
                        if (($field->type == 3) || ($field->type == 5))
                        {
                            echo '<th class="text-right '.$cl.'">'.$field->name.'</th>';
                        }
                        else
                        {
                            echo '<th class="'.$cl.'">'.$field->name.'</th>';
                        }
                    }   
                    if (!empty($actions))
                    {
                        $fieldcount++;
                        echo '<th class="text-right no-sort">Műveletek</th>';
                    }
                    echo '</tr>
                </thead>
                <tbody>';
                foreach($this->queryresult as $rekord)
                {
                    if (isset($rekord[$SetFlagFieldName]))
                    {
                        if (($rekord[$SetFlagFieldName] == 1))
                        {
                            $inaktive = '';
                            $icon = 'on';
                        }
                        else
                        {
                            $inaktive = 'class="text-muted"';   
                            $icon = 'off';
                        }
                    }
                    else
                    {
                        $inaktive = '';
                    }
                    
                    echo '<tr '.$inaktive.'>';
                    foreach($fields as $field)
                    {
                        if ($field->name[0] == '.')
                        {
                            $cl = 'collapse';
                        }
                        else
                        {
                            $cl = '';
                        }

                        if (is_numeric($rekord[$field->name]))
                        {
                            echo '<td class="text-right '.$cl.'">'.$this->numberFormat($rekord[$field->name]).'</td>';
                        }
                        else
                        {
                            echo '<td class="'.$cl.'">'.$rekord[$field->name].'</td>';
                        }
                    }
                    if (!empty($actions))
                    {
                        echo '<td class="text-right">';                      
                        // ha a paraméterben van 's',akkor megjelenítjük a státuszváltó ikont
                        if (in_array('s', $actions))
                        {
                            echo '
                            <a href="index.php?pg='.base64_encode($originaltablename.'_stch&id='.$rekord[$primary_key]).'" title="Státusz váltás">
                                <svg class="bi" width="20" height="20" fill="currentColor">
                                    <use xlink:href="icons/bootstrap-icons.svg#toggle-'.$icon.'"></use>
                                </svg>
                            </a>';
                        }

                          // ha a paraméterben van 'i',akkor megjelenítjük az információ ikont
                          if (in_array('i', $actions))
                          {
                              echo '
                              <a href="index.php?pg='.base64_encode($originaltablename.'_info&id='.$rekord[$primary_key]).'" title="Rekord információ">
                                  <svg class="bi" width="16" height="16" fill="currentColor">
                                      <use xlink:href="icons/bootstrap-icons.svg#info-circle-fill"></use>
                                  </svg>
                              </a>';
                          }

                         // ha a paraméterben van 'a',akkor megjelenítjük a attachment ikont
                         if (in_array('a', $actions))
                         {
                             echo '
                             <a href="index.php?pg='.base64_encode($originaltablename.'_attach&id='.$rekord[$primary_key]).'" title="Rekord módosítás">
                                 <svg class="bi" width="16" height="16" fill="currentColor">
                                     <use xlink:href="icons/bootstrap-icons.svg#plus-circle-fill"></use>
                                 </svg>
                             </a>';
                         }

                        // ha a paraméterben van 'u',akkor megjelenítjük a módosítás ikont
                        if (in_array('u', $actions))
                        {
                            echo '
                            <a href="index.php?pg='.base64_encode($originaltablename.'_update&id='.$rekord[$primary_key]).'" title="Rekord módosítás">
                                <svg class="bi" width="16" height="16" fill="currentColor">
                                    <use xlink:href="icons/bootstrap-icons.svg#exclamation-circle-fill"></use>
                                </svg>
                            </a>';
                        }

                        // ha a paraméterben van 'l',akkor megjelenítjük a letöltés ikont
                        if (in_array('l', $actions))
                        {
                            echo '
                            <a href="index.php?pg='.base64_encode($originaltablename.'_download&id='.$rekord[$primary_key]).'" title="Rekord letöltése">
                                <svg class="bi" width="16" height="16" fill="currentColor">
                                    <use xlink:href="icons/bootstrap-icons.svg#arrow-down-circle-fill"></use>
                                </svg>
                            </a>';
                        }

                          // ha a paraméterben van 'd',akkor megjelenítjük a törlés ikont
                          if (in_array('d', $actions))
                          {
                              echo '
                              <a href="index.php?pg='.base64_encode($originaltablename.'_delete&id='.$rekord[$primary_key]).'" title="Rekord törlés">
                                  <svg class="bi" width="16" height="16" fill="currentColor">
                                      <use xlink:href="icons/bootstrap-icons.svg#x-circle-fill"></use>
                                  </svg>
                              </a>';
                          }                        
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                echo '
                </tbody>
             <!--
                <tfoot>
                    <tr>
                        <td colspan="'.$fieldcount.'">Összesen <strong>'.$rekordcount.'</strong> rekord</td>
                    </tr>
                </tfoot>
            -->
            </table>';
        }

        // a lekérdezés adatainak megjelenítése egy HTML SELECT komponensben
        public function toSelect($table, $valueName, $optionName, $selectedValue, $condition)
        {
            if(!empty($condition))
            {
                $condition = ' WHERE '.$condition;
            }
            $this->DBquery("SELECT * FROM ".$table." ".$condition." ORDER BY ".$optionName." ASC");
                $options = '';
                foreach($this->queryresult as $rekord)
                {
                    if($selectedValue == $rekord[$valueName])
                    {
                        $selected = ' selected';
                    }
                    else
                    {
                        $selected = '';
                    }
                    $options .='<option value="'.$rekord[$valueName].'"'.$selected.'>'.$rekord[$optionName].'</option>';
                }
 
                return '<select name="'.$table.'" class="form-control">
                <option value="">Válasszon</option>'.$options.'</select>';
        }

        // a lekérdezés adatainak megjelenítése egy HTML GRID komponensben
        public function toGrid($title, $head, $body, $footer, $img, $link)
        {
            echo '<div class="row">';
                foreach($this->queryresult as $record)
                {
                    echo '<div class="col-12 col-lg-6 col-xl-4 py-3 px-3">
                    <div class="card">';
                    if(!empty($img))
                    {
                        echo '<img src="../cms/files/'.$record[$img].'" class="card-img-top" alt="'.$record[$img].'">';
                    }

                    echo'
                        <div class="card-body">
                        <h5 class="card-title">'.$record[$title].'</h5>
                        <h6 class="card-subtitle mb-2 text-muted">'.$record[$head].'</h6>
                        <p class="card-text text-justify">'.$record[$body].'</p>';
                    if(!empty($link))
                    {
                        echo '<a href="index.php?pg='.base64_encode($link.'&id='.$record['ID']).'" class="btn btn-secondary btn-sm">Részletek</a>';
                    }
                    echo '
                        </div>
                        <div class="card-footer text-muted font-italic">'.$record[$footer].'</div>
                    </div></div>';
                }
            echo '</div>';
        }
        
        // a lekérdezés adatainak megjelenítése egy JS diagramban
        public function toChart($title, $type, $x, $y, $div, $theme, $anim)
        {
            $data_points = '';
            foreach($this->queryresult as $rekord)
            {
                $data_points .= '{ label: "'.$rekord[$x].'",  y: '.$rekord[$y].'  },';
            }
            $data_points = rtrim($data_points, ',');
        

            echo '<script type="text/javascript">
            window.onload = function () {
            
            var chart = new CanvasJS.Chart("'.$div.'", {
                theme: "'.$theme.'", // "light1", light2", "dark1", "dark2"
                animationEnabled: '.$anim.', // false or true		
                title:{
                    text: "'.$title.'"
                },
                data: [
                {
                    // Change type to "bar", "area", "spline", "pie",etc.
                    type: "'.$type.'",
                    dataPoints: [
                     '.$data_points.'
                    ]
                }
                ]
            });
            chart.render();
            
            }
            </script>';
        }

        // // a lekérdezés adatainak megjelenítése egy FullCalendar komponensben
        public function toCalendar($title, $start, $end, $value, $div)
        {
            $events = '';
            foreach($this->queryresult as $rekord)
            {
                $str = '';
                $fields = explode('|',$value);
                foreach($fields as $field)
                {
                    if(is_numeric($rekord[$field]))
                    {
                        $str .= $this->numberFormat($rekord[$field]).' ';
                    }
                    else
                    {
                        $str .= $rekord[$field].' ';
                    }
                }
                $str = rtrim($str, ' ');

                $events .= '{ 
                    title: "'.$str.'",  
                    start: "'.$rekord[$start].'",
                    end:  "'.$rekord[$end].'" 
                },';
            }
            $events = rtrim($events, ',');

            echo "
            <h4>".$title."</h4>
            <hr>
            <script>

            document.addEventListener('DOMContentLoaded', function() {
              var initialLocaleCode = 'hu';
             
              var calendarEl = document.getElementById('".$div."');
          
              var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                  left: 'prevYear,prev,today,next,nextYear',
                  center: 'title',
                  right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                initialDate: '".$GLOBALS['today']."',
                locale: initialLocaleCode,
                buttonIcons: true, // show the prev/next text
                weekNumbers: true,
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                dayMaxEvents: true, // allow more link when too many events
                events: [
                  ".$events."
                ]
              });
          
              calendar.render();
          
            });
          
          </script>";
        }

        // a lekérdezés adatainak exportálása PDF-be
        public function toPDF()
        {

        }

        // a lekérdezés adatainak exportálása XLS-be
        public function toXLS()
        {

        }

        // egy rekord adatainak megjelenítése HTML táblázatban
        public function showRecord()
        {
            echo '<h4>Rekord információ</h4>
            <hr>
            <table class="table table-striped table-sm table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Tulajdonság</th>
                        <th>Érték</th>
                    </tr>
                </thead>
                <tbody>';
                $fields = array();
                $fields = $this->queryresult->fetch_fields();
                $fieldcount = $this->connection->field_count;
                $originaltablename = $fields[0]->orgtable;
                $rekord = $this->fetchOne();
                foreach($fields as $field)
                {
                    echo '<tr>
                        <td class="font-weight-bold">'.$field->name.'</td>
                        <td>';
                        if (is_numeric($rekord[$field->name]))
                        {
                            echo $this->numberFormat($rekord[$field->name]);
                        }
                        else
                        {
                            echo $rekord[$field->name];
                        }
                        echo '</td>
                    </tr>';
                }
                echo'
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">Összesen <strong>'.$fieldcount.'</strong> tulajdonság</td>
                    </tr>
                </tfoot>
            </table>
            <button onclick="javascript:history.back();" class="btn btn-secondary">Vissza</button>';
        }

        // üzenetablak
        public function showMessage($message, $type)
        {
            echo '<div class="alert alert-'.$type.' alert-dismissible fade show animated heartBeat" role="alert">
                '.$message.'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

        // formázott szám kiírás
        public function numberFormat($szam)
        {
            if ($pos = strpos($szam, '.') > 0)
            {           
                return number_format($szam, $GLOBALS['tizedes'], $GLOBALS['tizedeselv'], $GLOBALS['ezreselv']);
            }
            else
            {
                return number_format($szam, 0, $GLOBALS['tizedeselv'], $GLOBALS['ezreselv']);
            }   
        }

        // megadja az elsődleges kulcs nevét
        public function getPrimaryKey($fields)
        {
            $primary_key = '';
			foreach($fields as $field) 
			{
			    if ($field->flags & MYSQLI_PRI_KEY_FLAG) 
			    { 
			        $primary_key = $field->name; 
                    break;
			    }
			}
            return $primary_key;
        }

        // megadja az Set flag mező nevét
        public function getSetFlag($fields)
        {
            $SetFlag = '';
            foreach($fields as $field) 
            {
                if ($field->flags & MYSQLI_SET_FLAG) 
                { 
                    $SetFlag = $field->name; 
                    break;
                }
            }
            return $SetFlag;
        }

        //inputok megtisztítása
        public function escapeString($str)
        {
            return $this->connection->real_escape_string($str);
        }   
        
        public function logincheck($session)
        {
            if(!isset($_SESSION[$session]))
            {
                header("location: index.php");
            }
        }

        public function moderate($text, $words)
        {
            
            foreach($words as $word)
            {
                $mask = '***';
                $text = str_replace($word, $mask, $text);
            }
            return $text;
        }

        public function fileDowload($file)
        {
            if(file_exists($file))
            {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }
        }
    }
?>