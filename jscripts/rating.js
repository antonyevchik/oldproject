 
       function getRate(ir,fr,idn)
           {
           	s=2;
				if(fr==0) s=1;           	
           	
           	for(i=1; i<= ir; i++) {document.getElementById("r"+i+idn).src="rating/2.png";}
//				document.write(i+idn);
           	
           	if(fr>0.0&&fr<=0.25) document.getElementById("r"+(ir+1)+idn).src="rating/025.png";
           	if(fr>0.25&&fr<0.75) document.getElementById("r"+(ir+1)+idn).src="rating/050.png";
           	if(fr>=0.75&&fr<=0.9) document.getElementById("r"+(ir+1)+idn).src="rating/075.png"; 
          
           	for(j=ir+s; j<=5; j++) {document.getElementById("r"+j+idn).src="rating/0.png";}

           }

       function test()
       {
       	document.write("test");
       }
