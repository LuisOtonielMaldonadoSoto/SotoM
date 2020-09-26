package SOTOM;

public class Tarea {
    
    public static void main(String[] args) {

        int valor1=0;
        int valor2=1;
        int valor3;
        int x=10;

        System.out.println(valor1);
        System.out.println(valor2);

        do {
            valor3 = valor1 +valor2;
            System.out.println(valor3);
            valor1 = valor2;
            valor2 = valor3;
            x--;
        } while (x>=0);
        
    }
    
}