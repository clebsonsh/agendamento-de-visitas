const capitalizeFirstLetter = (string: string) =>
  string.charAt(0).toUpperCase() + string.slice(1);

const getFormatterdDate = (date: string) =>
  capitalizeFirstLetter(
    new Date(date).toLocaleDateString("pt-BR", {
      weekday: "long",
      month: "long",
      day: "numeric",
      year: "numeric",
      hour: "numeric",
      minute: "2-digit",
    }),
  );

const brlFormatter = (amount: number) =>
  new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
  }).format(amount);

export { capitalizeFirstLetter, getFormatterdDate, brlFormatter };
