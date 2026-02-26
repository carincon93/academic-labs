package factorial;

public class Factorial {
    public static void main(String[] args) {
        int factorial = factorial(8);

        System.out.println(factorial);
    }

    public static int factorial(int a) {
        if (a == 1) {
            return 1;
        }

        return a * factorial(a-1);
    }
}
