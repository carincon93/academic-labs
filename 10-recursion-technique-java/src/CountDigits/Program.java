package CountDigits;

public class Program {
    public static int count = 0;
    public static void main(String[] args) {
        int number = 50;
        int multiplier = 1;
        int countDigits = countDigits(number, multiplier);

        System.out.println(countDigits);
    }

    public static int countDigits(int number, int multiplier) {
        if(multiplier * 10 <= number) {
            count++;
        } else {
            return count + 1;
        }

        return countDigits(number, multiplier * 10);
    }
}
