<?php
/***********************************************************
COMO UTILIZAR:
No admin do wordpress:
* Ferramentas > Exportar > Download do arquivo de exportação

Na linha de comando:
php proccess-decs-add-mfn.php <path_arquivo_baixado>.xml

No admin do wordpress:
* Ferramentas > Importar
  Import o arquivo <path_arquivo_baixado>.xml
************************************************************/

// le o path do arquivo que foi passado por parâmetro
$file = NULL;
if (count($argv) > 1) {
    $file = $argv[1];
}

// parseia o xml do arquivo
$xml = simplexml_load_file($file) or die("Error: Cannot create object");;

$count = 0;
$alterados = 0;
$erro = 0;
foreach($xml->channel->item as $item) {
    
    foreach ($item->children('wp', true) as $postmeta) {
        $postmeta = $postmeta->children('wp', true);

        // selecionando somente os meta que são wpdecs_terms
        if($postmeta->meta_key == 'wpdecs_terms') {
            
            // transforma o item serializado em Array
            $data = unserialize($postmeta->meta_value);
            foreach($data as $key => $value) {
                
                $old_data = serialize($data);
                
                $count++;
                if($count % 10 == 0) {
                    print $count . "\n";
                }

                // separa o id e o termo
                list($id, $term) = explode("|", $key);

                // caso já existe mfn, pula
                if(array_key_exists('mfn', $data[$key])) {
                    continue;
                }
            
                // consome o webservice pelo tree_id
                $service = file_get_contents('http://decs.bvs.br/cgi-bin/mx/cgi=@vmx/decs/?tree_id=' . $id);

                // parseia o xml consumido
                $xml_service = simplexml_load_string($service);

                // xpath do mfn
                $records = $xml_service->xpath('/decsvmx/decsws_response/record_list/record');
                foreach($records as $record) {

                    // pega o mfn, caso exista
                    if($record->attributes()->mfn) {
                        $mfn = (int) $record->attributes()->mfn;

                        // atribui o mfn a estrutura
                        $data[$key]['mfn'] = $mfn;
                        
                        // faz um replace no arquivo $file
                        $count_file = 0;
                        $file_content = file_get_contents($file);
                        $file_content = str_replace($old_data, serialize($data), $file_content, $count_file);
                        if ($count == 0) {
                            print 'ERRO: $mfn';
                            $erro++;
                        } else {
                            $alterados++;
                            file_put_contents($file, $file_content);
                            // print_r($data);
                        }
                    }
                }
                
            }
        }
    }


} 
print "TOTAL: $count\n";
print "ERRO: $erro\n";
print "ALTERADOS: $alterados\n";
