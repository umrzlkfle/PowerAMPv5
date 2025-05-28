import pandas as pd
import sys

def process_csv(input_path, output_path):
    try:
        processed_df = (
            pd.read_csv(input_path, na_values=[''])
            .dropna(subset=['From_Info', 'To_Info'])
            .assign(
                Circ_id=lambda x: x['Circ_id'].combine_first(
                    x['From_Info'].str.split(':', n=1).str[0].str.strip()
                )
            .query("Voltage == '33.000 kV'")
            .assign(Circ_label=lambda x: x['Circ_id'].str.split('_').str[0])
            )
        )   
        
        processed_df.to_csv(output_path, index=False)
        print(f'''Processed {len(processed_df)} records with:
- Missing Circ_id filled from From_Info
- 33kV filtering
- Circ_label generation''')
        return True
        
    except Exception as e:
        print(f"Error: {str(e)}")
        return False

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python cleaning_MVUG.py <input_path> <output_path>")
        sys.exit(1)
        
    success = process_csv(sys.argv[1], sys.argv[2])
    sys.exit(0 if success else 1)