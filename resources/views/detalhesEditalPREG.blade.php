@extends('layouts.app')
@section('titulo','Detalhes do Edital')
@section('navbar')
    <!-- Home / Detalhes do edital -->
    <li class="nav-item active">
      <a class="nav-link" style="color: black" href="{{ route('home') }}"
         onclick="event.preventDefault();
                       document.getElementById('VerEditais').submit();">
         {{ __('Home') }}
      </a>
      <form id="VerEditais" action="{{ route('home') }}" method="GET" style="display: none;">

      </form>
    </li>
    <li class="nav-item active">
      <a class="nav-link">/</a>
    </li>

    <li class="nav-item active">
      <a class="nav-link" >
        {{ __('Detalhes do Edital')}}
      </a>

    </li>

@endsection
@section('content')

<style type="text/css">

</style>

<div class="tela-servidor ">
  <div class="centro-cartao" >
    <div class="card-deck d-flex justify-content-center">
      <div class="conteudo-central d-flex justify-content-center"  style="width: 100rem">  <!-- info edital -->
        <div class="card cartao text-top " style="border-radius: 20px">    <!-- Info -->

         <div class="card-header d-flex justify-content-center" style="background-color: white;margin-top: 10px">
           <h2 style="font-weight: bold">
            <?php
             $nomeEdital = explode(".pdf", $edital->nome);
             echo ($nomeEdital[0]);
            ?>
          </h2>

         </div>
         <a style="padding: 15px">
          A Pró-Reitora de Ensino de Graduação torna público para conhecimento dos interessados que, no
          PERÍODO DE 29/05 a 05/06 DE 2019, estarão abertas às inscrições para o Processo Seletivo Extra que
          visa o preenchimento de vagas para Ingresso via Processo Seletivo Extra nos Cursos de Graduação no 2o
          semestre de 2019, de acordo com as normas regimentais da UFRPE (Resolução 410/2007; 354/2008;
          34/2008181/91)
         </a>
        </div>
      </div>
      <div class="conteudo-central d-flex justify-content-center" style="width: 100rem">  <!-- opções -->
        <div class="card cartao text-center " style="border-radius: 20px; height: 21rem;">    <!-- Isenção -->
          <div class="card-header d-flex justify-content-center" style="margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
            <h2 style="font-weight: bold">Isenção</h2>
          </div>
          <div class="card-header d-flex justify-content-center">
            <h5>
              Aberto de: <br>
                <a style="font-weight: bold">
                  {{date_format(date_create($edital->inicioIsencao), 'd/m/y')}}
                </a>
                 até
                <a style="font-weight: bold">
                  {{date_format(date_create($edital->fimIsencao), 'd/m/y')}}
                </a>
            </h5>
          </div>
          <div class="container justify-content-center" style="height: 8rem; background-color: #F7F7F7; padding: 10px">
            <h4>
              <?php
                $porcentagem = $isencoesHomologadas * 100;
                if(($isencoesHomologadas + $isencoesNaoHomologadas)>0){
                  $porcentagem = $porcentagem / ($isencoesHomologadas + $isencoesNaoHomologadas);
                }
                else{
                  $porcentagem = 0;
                }
               ?>
               @if(($isencoesHomologadas + $isencoesNaoHomologadas) > 0 )
                <a style="font-weight: bold">Etapa {{{$porcentagem}}}% finalizada.</a>
               @endif
            </h4>
            <h5>

                Total de Inscrições: <a style="font-weight: bold">{{($isencoesHomologadas + $isencoesNaoHomologadas)}}.</a>

            </h5>
              <h5>
                Inscrições homologadas: <a style="font-weight: bold">{{$isencoesHomologadas}}.</a>
              </h5>
              <h5>
                Inscrições em espera: <a style="font-weight: bold">{{$isencoesNaoHomologadas}}.</a>
              </h5>
          </div>

          <div class="container justify-content-center" style="padding: 13px;background-color: #F7F7F7; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >  <!-- form Isenção -->
            <form method="GET" action="{{route('editalEscolhido')}}">

              <input type="hidden" name="editalId" value="{{$edital->id}}">
              <input type="hidden" name="tipo" value="homologarIsencao">

              @if($edital->inicioIsencao<= $mytime)
                @if($edital->fimIsencao >= $mytime)
                  <button type="submit" class="btn btn-primary btn-primary-lmts" >
                    {{ __('Homologar Isenção') }}
                  </button>
                @else
                  <button type="submit" disabled class="btn btn-primary btn-primary-lmts"  >
                    {{ __('Homologar Isenção') }}
                  </button>
                @endif
              @else
                <button type="submit" disabled class="btn btn-primary btn-primary-lmts"  >
                  {{ __('Homologar Isenção') }}
                </button>
              @endif
            </form>
          </div>

        </div>

        <div class="card cartao text-center " style="border-radius: 20px;height: 21rem;"> <!-- Recurso Isenção -->
          <div class="card-header d-flex justify-content-center" style="margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
            <h2 style="font-weight: bold">Recurso Isenção</h2>
          </div>

          <div class="card-header d-flex justify-content-center">
              <h5>
               Aberto de: <br>
                 <a style="font-weight: bold">
                   {{date_format(date_create($edital->inicioRecursoIsencao), 'd/m/y')}}
                 </a>
                  até
                 <a style="font-weight: bold">
                   {{date_format(date_create($edital->fimRecursoIsencao), 'd/m/y')}}
                 </a>
              </h5>
          </div>
          <div class="container justify-content-center" style="height: 8rem; background-color: #F7F7F7; padding: 10px">
            <h4>
              <?php
                $porcentagem = $recursosTaxaHomologados * 100;
                if(($recursosTaxaHomologados + $recursosTaxaNaoHomologados)>0){
                  $porcentagem = $porcentagem / ($recursosTaxaHomologados + $recursosTaxaNaoHomologados);
                }
                else{
                  $porcentagem = 0;
                }
               ?>
               @if(($recursosTaxaHomologados + $recursosTaxaNaoHomologados) > 0 )
                <a style="font-weight: bold">Etapa {{{$porcentagem}}}% finalizada.</a>
               @endif
            </h4>
            <h5>

                Total de Inscrições: <a style="font-weight: bold">{{($recursosTaxaHomologados + $recursosTaxaNaoHomologados)}}.</a>

            </h5>
              <h5>
                Inscrições homologadas: <a style="font-weight: bold">{{$recursosTaxaHomologados}}.</a>
              </h5>
              <h5>
                Inscrições em espera: <a style="font-weight: bold">{{$recursosTaxaNaoHomologados}}.</a>
              </h5>
          </div>


          <div class="container justify-content-center" style="padding: 13px;background-color: #F7F7F7; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
            <form method="GET" action="{{route('editalEscolhido')}}">

              <input type="hidden" name="editalId" value="{{$edital->id}}">
              <input type="hidden" name="tipo" value="homologarRecursos">

              @if($edital->inicioRecursoIsencao <= $mytime)
              @if($edital->fimRecursoIsencao >= $mytime)
              <button type="submit" class="btn btn-primary btn-primary-lmts" >
                {{ __('Homologar Recursos Isenção') }}
              </button>
              @else
              <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                {{ __('Homologar Recursos Isenção') }}
              </button>
              @endif
              @else
              <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                {{ __('Homologar Recursos Isenção') }}
              </button>
              @endif

            </form>
          </div>
        </div>

        <div class="card cartao text-center " style="border-radius: 20px; height: 21rem">   <!-- Inscrição -->
             <div class="card-header d-flex justify-content-center" style="margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
                 <h2 style="font-weight: bold">Inscrição</h2>
             </div>
             <div class="card-header d-flex justify-content-center">
                 <h5>
                  Aberto de: <br>
                    <a style="font-weight: bold">
                      {{date_format(date_create($edital->inicioInscricoes), 'd/m/y')}}
                    </a>
                     até
                    <a style="font-weight: bold">
                      {{date_format(date_create($edital->fimInscricoes), 'd/m/y')}}
                    </a>
                 </h5>
             </div>
             <div class="container justify-content-center" style="height: 8rem; background-color: #F7F7F7; padding: 10px">
               <h4>
                 <?php
                   $porcentagem = $inscricoesHomologadas * 100;
                   if(($inscricoesHomologadas + $inscricoesNaoHomologadas)>0){
                     $porcentagem = $porcentagem / ($inscricoesHomologadas + $inscricoesNaoHomologadas);
                   }
                   else{
                     $porcentagem = 0;
                   }
                  ?>
                  @if(($inscricoesHomologadas + $inscricoesNaoHomologadas) > 0 )
                   <a style="font-weight: bold">Etapa {{{$porcentagem}}}% finalizada.</a>
                  @endif
               </h4>
               <h5>

                   Total de Inscrições: <a style="font-weight: bold">{{($inscricoesHomologadas + $inscricoesNaoHomologadas)}}.</a>

               </h5>
                 <h5>
                   Inscrições homologadas: <a style="font-weight: bold">{{$inscricoesHomologadas}}.</a>
                 </h5>
                 <h5>
                   Inscrições em espera: <a style="font-weight: bold">{{$inscricoesNaoHomologadas}}.</a>
                 </h5>
             </div>
            <div class="container justify-content-center" style="padding: 13px;background-color: #F7F7F7; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
               <form method="GET" action="{{route('editalEscolhido')}}">

                   <input type="hidden" name="editalId" value="{{$edital->id}}">
                   <input type="hidden" name="tipo" value="homologarInscricoes">

                   @if($edital->inicioInscricoes <= $mytime)
                     @if($edital->fimInscricoes >= $mytime)
                       <button type="submit" class="btn btn-primary btn-primary-lmts ">
                           {{ __('Homologar Inscrições') }}
                       </button>
                     @else
                     <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                         {{ __('Homologar Inscrições') }}
                     </button>
                     @endif
                   @else
                   <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                       {{ __('Homologar Inscrições') }}
                   </button>
                   @endif
               </form>
             </div>
        </div>

        <div class="card cartao text-center " style="border-radius: 20px;height: 21rem">   <!-- Recuso Inscrição -->
             <div class="card-header d-flex justify-content-center" style="margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
                 <h2 style="font-weight: bold">Recurso Inscrição</h2>
             </div>

             <div class="card-header d-flex justify-content-center">
                 <h5>
                  Aberto de: <br>
                    <a style="font-weight: bold;">
                      {{date_format(date_create($edital->inicioRecurso), 'd/m/y')}}
                    </a>
                     até
                    <a style="font-weight: bold">
                      {{date_format(date_create($edital->fimRecurso), 'd/m/y')}}
                    </a>
                 </h5>
             </div>
             <div class="container justify-content-center" style="height: 8rem; background-color: #F7F7F7; padding: 10px">
               <h4>
                 <?php
                   $porcentagem = $recursosClassificacaoHomologados * 100;
                   if(($recursosClassificacaoHomologados + $recursosClassificacaoNaoHomologados)>0){
                     $porcentagem = $porcentagem / ($recursosClassificacaoHomologados + $recursosClassificacaoNaoHomologados);
                   }
                   else{
                     $porcentagem = 0;
                   }
                  ?>
                  @if(($recursosClassificacaoHomologados + $recursosClassificacaoNaoHomologados) > 0 )
                   <a style="font-weight: bold">Etapa {{{$porcentagem}}}% finalizada.</a>
                  @endif
               </h4>
               <h5>

                   Total de Inscrições: <a style="font-weight: bold">{{($recursosClassificacaoHomologados + $recursosClassificacaoNaoHomologados)}}.</a>

               </h5>
                 <h5>
                   Inscrições homologadas: <a style="font-weight: bold">{{$recursosClassificacaoHomologados}}.</a>
                 </h5>
                 <h5>
                   Inscrições em espera: <a style="font-weight: bold">{{$recursosClassificacaoNaoHomologados}}.</a>
                 </h5>
             </div>
             <div class="container justify-content-center" style="padding: 13px;background-color: #F7F7F7; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px" >
               <form method="GET" action="{{route('editalEscolhido')}}">

                   <input type="hidden" name="editalId" value="{{$edital->id}}">
                   <input type="hidden" name="tipo" value="homologarRecursos">

                   @if($edital->inicioRecurso <= $mytime)
                     @if($edital->fimRecurso >= $mytime)
                       <button type="submit" class="btn btn-primary btn-primary-lmts" >
                           {{ __('Homologar Recursos Inscrição') }}
                       </button>
                     @else
                     <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                         {{ __('Homologar Recursos Inscrição') }}
                     </button>
                     @endif
                   @else
                   <button type="submit" disabled class="btn btn-primary btn-primary-lmts">
                       {{ __('Homologar Recursos Inscrição') }}
                   </button>
                   @endif

               </form>
             </div>
           </div>

        <div class="card cartao text-center " style="border-radius: 20px;height: 21rem">    <!-- Classificação -->
         <div class="card-header d-flex justify-content-center" style="margin-top: -50px; border-top-left-radius: 20px; border-top-right-radius: 20px">
           <h2 style="font-weight: bold">Classificação</h2>
         </div>
         <div class="card-header d-flex justify-content-center">
             <h5>
              Data de divulgação: <br>
                <a style="font-weight: bold;">
                  {{date_format(date_create($edital->resultado), 'd/m/y')}}
                </a>

             </h5>
         </div>
         <div class="container justify-content-center" style="height: 8rem; background-color: #F7F7F7; padding: 10px">
           <h4>
             <?php
               $porcentagem = $inscricoesClassificadas * 100;
               if(($inscricoesClassificadas + $inscricoesNaoClassificadas)>0){
                 $porcentagem = $porcentagem / ($inscricoesClassificadas + $inscricoesNaoClassificadas);
               }
               else{
                 $porcentagem = 0;
               }
              ?>
              @if(($inscricoesClassificadas + $inscricoesNaoClassificadas) > 0 )
               <a style="font-weight: bold">Etapa {{{$porcentagem}}}% finalizada.</a>
               <a href="{{ route('detalhesPorcentagem') }}"
                  onclick="event.preventDefault();
                                document.getElementById('detalhesPorcentagem-form').submit();">
                  ?
               </a>
               <form id="detalhesPorcentagem-form" target="_blank" action="{{ route('detalhesPorcentagem') }}" method="get" style="display: none;">

                 <input type="hidden" name="editalId" value="{{$edital->id}}">
               </form>
              @endif
           </h4>
           <h5>

               Total de Inscrições: <a style="font-weight: bold">{{($inscricoesClassificadas + $inscricoesNaoClassificadas)}}.</a>

           </h5>
             <h5>
               Inscrições homologadas: <a style="font-weight: bold">{{$inscricoesClassificadas}}.</a>
             </h5>
             <h5>
               Inscrições em espera: <a style="font-weight: bold">{{$inscricoesNaoClassificadas}}.</a>
             </h5>
         </div>

         <div class="container justify-content-center" style="padding: 13px;background-color: #F7F7F7; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px"   <!-- form Classificação -->
           <form method="POST" action="{{route('gerarClassificacao')}}" target="_blank" enctype="multipart/form-data">
             @csrf
             <input type="hidden" name="editalId" value="{{$edital->id}}">
             <input type="hidden" name="tipo" value="homologarIsencao">

             @if(($edital->resultado <= $mytime) && ($porcentagem == 100))
               <button type="submit" class="btn btn-primary btn-primary-lmts" >
                 {{ __('Gerar Resultado') }}
               </button>
             @else
               <button type="submit" disabled class="btn btn-primary btn-primary-lmts"  >
                 {{ __('Gerar Resultado') }}
               </button>
             @endif
           </form>
         </div>
        </div>
      </div>

    </div>
  </div>
</div>

@if(session()->has('jsAlert'))
    <script>
        alert('{{ session()->get('jsAlert') }}');
    </script>
@endif



@endsection