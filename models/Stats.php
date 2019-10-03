<?php
    if (!defined("_VALID_PHP")){
        die('Acesso direto negado');
    }

    class Stats extends model{

        private $ip;
        private $os;
        private $browser;
        private $device;
        private $referer;

        public function getBrowser(){
            
            $agent = $_SERVER['HTTP_USER_AGENT'];

            if(preg_match('/Firefox/i', $agent)){
                $this->browser = 'Firefox'; 
            }elseif(preg_match('/Edge/i', $agent)){
                $this->browser = 'Edge'; 
            }elseif(preg_match('/OPR/i', $agent) || preg_match('/Opera/i', $agent)){
                $this->browser = 'Opera'; 
            }elseif(preg_match('/Chrome/i', $agent)){
                $this->browser = 'Chrome'; 
            }elseif(preg_match('/Safari/i', $agent)){
                $this->browser = 'Safari'; 
            }elseif(preg_match('/MSIE/i', $agent) || preg_match('/Trident/i', $agent)){
                $this->browser = 'Internet Explorer'; 
            }else{
                $this->browser = 'Unknown';
            }
        }


        public function getDevice(){
            
            $agent = $_SERVER['HTTP_USER_AGENT'];

            if(preg_match('/Windows/i', $agent)){
                $this->os = 'Windows';
                $this->device = 'Desktop';
            }elseif(preg_match('/iPhone/i', $agent)){
                $this->os = 'iPhone'; 
                $this->device = 'Mobile';
            }elseif(preg_match('/iPad/i', $agent)){
                $this->os = 'iPad'; 
                $this->device = 'Mobile';
            }elseif(preg_match('/Mac/i', $agent)){
                $this->os = 'Mac'; 
                $this->device = 'Desktop';
            }elseif(preg_match('/Droid/i', $agent)){
                $this->os = 'Android'; 
                $this->device = 'Mobile';
            }elseif(preg_match('/Unix/i', $agent)){
                $this->os = 'Unix'; 
                $this->device = 'Desktop';
            }elseif(preg_match('/Linux/i', $agent)){
                $this->os = 'Linux';
                $this->device = 'Desktop';
            }else{
                $this->os = 'Unknown';
                $this->device = 'Unknown';
            }
        }

        
        public function setStats(){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $this->ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $this->ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $this->ip = $_SERVER['REMOTE_ADDR'];
            }

            if(isset($_SERVER['HTTP_REFERER'])){
                $this->referer = $_SERVER['HTTP_REFERER'];
            }else{
                $this->referer = '';
            }

            $this->getBrowser();
            $this->getDevice();

            try {
                if (function_exists('curl_version')){
                    $curl = curl_init();  
                    curl_setopt($curl, CURLOPT_URL, 'https://geoip-db.com/json/'.$this->ip);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $stats = json_decode(curl_exec($curl), true);
                    curl_close($curl);
                }else{
                    $stats = json_decode(file_get_contents('https://geoip-db.com/json/'.$this->ip), true);
                }
    
                if(is_array($stats)){
                    $data = array(
                        'ip'           => $this->ip,
                        'browser'      => $this->browser,
                        'device'       => $this->device,
                        'os'           => $this->os,
                        'country'      => $stats['country_name'],
                        'country_code' => $stats['country_code'],
                        'region'       => $stats['state'],
                        'city'         => $stats['city'],
                        'reference'    => $this->referer,
                        'date'         => date('Y-m-d H:i:s')
                    );
    
                    $this->db->insert('stats', $data);
                }
            } catch (\Throwable $th) {
               //
            }

        }

        public function getStats(){
            return $this->db->fetchAll("SELECT idMonth, COUNT(DISTINCT ip) as visits, COUNT(id) as hits FROM stats RIGHT JOIN (SELECT 1 as idMonth UNION SELECT 2 as idMonth UNION SELECT 3 as idMonth UNION SELECT 4 as idMonth UNION SELECT 5 as idMonth UNION SELECT 6 as idMonth UNION SELECT 7 as idMonth UNION SELECT 8 as idMonth UNION SELECT 9 as idMonth UNION SELECT 10 as idMonth UNION SELECT 11 as idMonth UNION SELECT 12 as idMonth) as Month ON Month.idMonth = MONTH(date) AND YEAR(date) = YEAR(CURDATE()) GROUP BY Month.idMonth");
        }

        public function clearStats(){
            $this->db->truncate('stats');

            $json['heading'] = "Sucesso";
            $json['text'] =  "Estatísticas apagadas com sucesso!";
            $json['icon'] = 'success';
            echo json_encode($json);
        }

        public function getUniqueVisits(){
            return $this->db->fetchOne("SELECT COUNT(DISTINCT ip) as uniquevisits FROM stats");
        }

        public function getTotalHits(){
            $result = $this->db->fetchRow("SELECT COUNT(id) as total FROM stats WHERE YEAR(date) = YEAR(CURDATE())");
            return ($result['total']) ? $result['total'] : 0;
        }

        public function getOnline(){
            return $this->db->fetchOne("SELECT COUNT(DISTINCT ip) as online FROM stats WHERE YEAR(date) = YEAR(CURDATE()) AND date > NOW() - INTERVAL 5 MINUTE");
        }

        public function getVisitsToday(){
            return $this->db->fetchOne("SELECT COUNT(DISTINCT ip) as today FROM stats WHERE DATE(date) = CURDATE()");
        }

        public function getStatsBrowser(){
            return $this->db->fetchAll("SELECT S.browser, COUNT(*) total, ROUND((COUNT(*) / total * 100), 2) as percentage FROM (SELECT COUNT(*) total FROM stats) t JOIN stats as S GROUP BY S.browser ORDER BY percentage DESC");
        }

        public function getStatsDevice(){
            return $this->db->fetchAll("SELECT S.device, COUNT(*) total, ROUND((COUNT(*) / total * 100), 2) as percentage FROM (SELECT COUNT(*) total FROM stats) t JOIN stats as S GROUP BY S.device ORDER BY percentage DESC");
        }

        public function getOnlineData(){
            return $this->db->fetchAll("SELECT * FROM stats WHERE YEAR(date) = YEAR(CURDATE()) AND date > NOW() - INTERVAL 5 MINUTE GROUP BY ip");
        }

    }
?>