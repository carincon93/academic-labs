package pow;

public class Pow {

    public static void main(String[] args) {
        int pow = pow(2, 3);
        System.out.println(pow);
    }

    public static int pow(int a, int b) {
        if (b == 0) {
            return 1;
        }

        return a * pow(a,b-1);
    }
}
