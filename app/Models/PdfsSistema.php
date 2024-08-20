<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TCPDF;

class PdfsSistema extends Model
{
    public static function listaDevolucao($dados){
        $ProdutosArray = [];
        $i=0;
        foreach($dados['notas'] as $prod){
            if(!isset($prod['produtos'])){
                throw new Exception('não há produtos cadastrado para essa carga');
            }
            foreach($prod['produtos'] as $item){
                $ProdutosArray[$item->nome][] = ['qtd'=>$item->quantidade];

            }
        }

        try{
            $titulo = 'Ordem de Devolução - AS '.$dados['dados']['os'];
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->setCreator('Sistema de Transportes: ' . Auth::user()->empresa->first()->nome);
            $pdf->setAuthor('Davi Santos da Silva');
            $pdf->setTitle($titulo);

            $pdf->setHeaderData('', 1, $titulo,
            'Empresa: '. Auth::user()->empresa->first()->nome.'      Data e Hora: ' . date('d/m/Y H:i:s'), array(0, 0, 0), array(0, 0, 0));
            $pdf->setHeaderMargin(0);

            $pdf->AddPage();
            $pdf->MultiCell(50, '', 'Usuário: ' . Auth::user()->login, 0, 'L', false, '', '', '', true);

            $pdf->Ln(4);
            $pdf->Ln(4);
            $pdf->MultiCell(55, '', 'AS: ' . $dados['dados']['os'], 0, 'L', false, '', '', '', true);
            $pdf->MultiCell(45, '', 'Remessa: ' . $dados['dados']['remessa'], 0, 'L', false, '', 41, '', true);
            $pdf->MultiCell(210, '', 'Motorista AS: ' . Carga::find($dados['dados']['carga'])->motorista->name, 0, 'L', false, '', '', '', true);
            $pdf->Ln(4);

            $pdf->Ln(6);

            $html = '';
            $html.='<div><table>';
                $html.='
                <tr>
                    <td style="width:450px"><b>Produto</b></td>
                    <td style="width:50px"><b>Qtd</b></td>
                    <td style="width:50px"><b>Entrada</b></td>
                </tr>
                ';
                $ind = 0;
                $qtdItens=0;
            foreach($ProdutosArray as $produto => $item){
                $qtd = 0;
                for($i=0;$i<count($item);$i++){
                    $qtd+=$item[$i]['qtd'];
                }
                if(($ind%2)==0){
                    $bg = "#eaeae9";
                }else{
                    $bg = "#fff";
                }
                $qtdItens+=$qtd;
                $html .='
                <tr style="background-color:'.$bg.'">
                    <td style="width:450px; ">'.$produto.'</td>
                    <td style="width:50px">'.$qtd.'</td>
                    <td style="width:50px"></td>
                </tr>
                ';
                $ind++;
            }
            $html.='<tr style="background-color:#ccc;">
                <td style="width:450px; text-align:right;">Total Itens: &nbsp;&nbsp;</td>
                <td style="width:100px; "><b>'.$qtdItens.'</b></td>
            </tr>';
            $html.='</table></div>';

            $html.='<div><table>';
                $html.='
                <tr>
                    <td style="width:100px"><b>Nota</b></td>
                    <td style="width:300px"><b>Destinatario</b></td>
                    <td style="width:100px"><b>Qtd</b></td>
                </tr>
                ';
                $ind=0;

            foreach($dados['notas'] as $nota){
                if(($ind%2)==0){
                    $bg = "#eaeae9";
                }else{
                    $bg = "#fff";
                }

                $html .='
                <tr style="background-color:'.$bg.'">
                    <td style="width:100px; ">'.$nota['nota']->nota.'</td>
                    <td style="width:300px">'.$nota['nota']->destinatario->nome_razao_social.'</td>
                    <td style="width:100px">'.$nota['nota']->volume.'</td>
                </tr>';
                $obs = $nota['nota']->observacoes;
                if($obs){
                    $html.='
                    <tr style="background-color:'.$bg.'; color:#666;">
                    <td style="width:500px">Motivo: '.$obs->last()->descricao.'</td>
                    </tr>
                    ';
                }else{
                    $html.='
                    <tr>
                    <td style="width:300px">Motivo: ----</td>
                    </tr>
                    ';
                }


                $ind++;
            }
            $html.='</table></div>';
            // $pdf->Ln(9);
            $html .= '<div style="display:flex;">
                        <div style="">____________________________, em _____/_____/________ as _____:_____<br>
                            Assinatura Encarregado '.Auth::user()->empresa->first()->nome.'
                        </div>
                        <div>____________________________, em _____/_____/________ as _____:_____ <br>
                            Assinatura Motorista
                        </div>
                        <div>____________________________, em _____/_____/________ as _____:_____, doca: _______ <br>
                            Assinatura Conferente
                        </div>
                    </div>';
            $pdf->writeHTMLCell('', '', '', '', $html, 0, 0, 0, true, 'L', false);
            // $pdf->MultiCell(95, '', 'OS: ', 0, 'L', false, '', '', '', true);
            $pdf->SetY(0);
            $pdf->Cell(0, 0, 'Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');


            // $pdf->AddPage();
            // $pdf->Cell(0, 0, 'Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
            $pdf->Output($titulo.'.pdf', 'I');
        }catch(Exception $ex){
            print_r($ex->getMessage());
        }
    }
}
