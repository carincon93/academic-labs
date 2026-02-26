package count_odd_even;

public class Count {
    public static int index = 0;
    public static int countOdd = 0;
    public static int countEven = 0;
    public static void main(String[] args) {
        int[] array = new int[]{2,7,9,13,8};

        countOdd(array);

        System.out.println("odd numbers count = "+countOdd);
        System.out.println("even numbers count = "+countEven);
    }

    public static int countOdd(int[] a) {
        if (index == a.length) {
            return 0;
        }

        if(a[index] % 2 == 0) {
            countOdd++;
        } else {
            countEven++;
        }

        index++;
        return countOdd(a);
    }
}
