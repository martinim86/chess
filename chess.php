<?php

try {
    foreach (glob('src/*.php') as $file) {
        require_once $file;
    }

    $desk = new Desk();

    $args = $argv;
    array_shift($args);
    $queue = [];
    $pawns = [];
    foreach($args as $item) {
        $a = $item[0];
        $b = $item[1];
        $queue[] = $desk->figures[$a][$b]->isBlack == True? 1:0;
        // var_dump($desk->figures[$a][$b]);
        
        if($desk->figures[$a][$b] instanceof Pawn){
            $pawns[] = $item;
        }
    }
   
    foreach($pawns as $pawn) {
        if($pawn[1]==  "2" || $pawn[1]==  "7"){
                $dif = abs($pawn[4] - $pawn[1]);
                if($dif >2 ){ 
                    throw new Exception('Если пешка ещё ни разу не ходила, она может пойти вперёд на две клетки;');
                }
        } 
        if($pawn[1] !==  "2" ){
            $dif = abs($pawn[4] - $pawn[1]);
            if($dif > 1 ){ 
                throw new Exception('Пешка может ходить вперёд (по вертикали) на одну клетку;');
            }
            
       
        } 
        if($pawn[1] !==  "7" ){
            $dif = abs($pawn[4] - $pawn[1]);
            if($dif > 1 ){ 
                throw new Exception('Пешка может ходить вперёд (по вертикали) на одну клетку!;');
            }
            
       
        } 
    }
    foreach($queue as $item2) {
        
        if($queue[$item2] + $queue[$item2+1]% 2 === 1){
            
                foreach ($args as $move) {
                    
                    $desk->move($move);
                
                }
        } else {
            throw new Exception('Нельзя ходить два хода.');
        }
    }
   

    $desk->dump();
} catch (\Exception $e) {
    echo $e->getMessage() . "\n";
    exit(1);
}
