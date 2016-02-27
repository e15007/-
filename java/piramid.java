

public class piramid {
public static void main (String arg[]){


 int stage = 4;






int space = stage -1;

int block =1;

for (int a = 1; a<= stage;a++){

for (int b=1;b<=space;b++){
System.out.print("  ");
}

for(int c=1;c<=block;c++){
System.out.print("■");

}
System.out.println("");
block+=2;
space--;




}


}


}	