package PrimeNumber;

public class Program {
    public static void main(String[] args) {
        int number = 17;
        int initialMultiplicand = 2;
        int initialMultiplier = 1;
        String message = primeNumber(number,initialMultiplicand,initialMultiplier);

        System.out.println(message);
    }

    public static String primeNumber(int number, int multiplicand, int multiplier) {
        if (number == 0 || number == 1) {
            return number+" es un número especial que no se considera primo ni compuesto";
        }

        if (multiplicand == number) {
            return "Si";
        } else if(multiplicand * multiplier == number) {
            return "No";
        }

        if(multiplicand * multiplier > number) {
            multiplier = 1;
            multiplicand++;
        }

        return primeNumber(number, multiplicand, multiplier+1);
    }
}
