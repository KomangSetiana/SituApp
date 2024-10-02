const formatDate = (date) => {
    const d = new Date(date);
    const dtf = new Intl.DateTimeFormat("id-ID", {
        year: "numeric",
        month: "long",
        day: "2-digit",
    });
    const [{ value: Fdate }, , { value: Fmount }, , { value: Fyear }] =
        dtf.formatToParts(d);
    return `${Fdate} ${Fmount}, ${Fyear}`;
};
export default formatDate;
