package divison;

public class Division {
    public static  int times = 0;

    public static void main(String[] args) {
        int x = dividir(60,15);
        System.out.println(x);
    }

    public static int dividir(int a, int b) {
        if(b > a) {
            return times;
        }
        times++;
        return dividir(a-b, b);
    }
}
